<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EDRSecurity
{
    public static function EdrScan(Request $request, $started):string
    {
        if (self::detectBrokenObjectLevelAuth($request,$started)){
            $status_edr = self::edr_status('Broken Object Level Authorization',$request->method(),$request->getRequestUri(),$request->ip());
        } elseif (self::detectJSONInjection($request,$started)){
            $status_edr = self::edr_status('JSON Injection',$request->method(),$request->getRequestUri(),$request->ip());
        } elseif (self::detectSQLInjection($request,$started)){
            $status_edr = self::edr_status('SQL Injection',$request->method(),$request->getRequestUri(),$request->ip());
        } elseif (self::detectIDOR($request,$started)) {
            $status_edr = self::edr_status('Insecure Direct Object Reference',$request->method(),$request->getRequestUri(),$request->ip());
        } elseif (self::detectSessionHijacking($request,$started)){
            $status_edr = self::edr_status('Session Hijacking',$request->method(),$request->getRequestUri(),$request->ip());
        } else {
            $status_edr = self::edr_status('undetected',$request->method(),$request->getRequestUri(),$request->ip());
            $ended = now();
            DB::table('log_activity_microservices')
                ->where('microservice_id',$request->input('microservice_id'))
                ->where('request_by_ip',$request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);
            LogService::insert('edr',$request,null,$started,$ended,'undetected');
        }
        return $status_edr;
    }

    private static function detectSessionHijacking(Request $request,$started): bool
    {
        // Check IP and User-Agent consistency (simpan di session)
        $session = session();
        $ip = $request->ip();
        $ua = $request->userAgent();

        if (!$session->has('session_ip')) {
            $session->put('session_ip', $ip);
            $session->put('session_ua', $ua);
        }

        if ($session->get('session_ip') !== $ip || $session->get('session_ua') !== $ua) {
            $ended = now();
            $status_edr = self::edr_status('Session Hijacking',$request->method(),$request->getRequestUri(),$request->ip());
            DB::table('log_activity_microservices')
                ->where('microservice_id',$request->input('microservice_id'))
                ->where('request_by_ip',$request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);
            LogService::insert('edr',$request,null,$started,$ended,'Session Hijacking');
            return true;
        }

        return false;
    }

    private static function detectBrokenObjectLevelAuth(Request $request,$started): bool
    {
        // Misal: endpoint tertentu harus punya role
        $msId = $request->input('microservice_id');
        $authorization = $request->bearerToken();
        $accessKey  = $request->header('Access-Key');
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $msTarget = $request->input('microservice_target');

        $ms = DB::table('vw_microservice')
            ->where('microservice_id', $msId)
            ->where('microservice_path', $msPath)
            ->where('microservice_methode', strtoupper($msMethod))
            ->where('microservice_target', $msTarget)
            ->first();

        $user = DB::table('vw_user')
            ->where('jwt_token',$authorization)
            ->where('public_key',$accessKey)
            ->first();

        $usname = DB::table('usernames')
            ->where('user_id',$user->user_id)
            ->first();

        $role = DB::table('roles')
            ->where('role_id',$usname->role_id)
            ->first();

        if ($ms->created_by != $usname->user_id && $role->name_role != 'admin') {
            $ended = now();
            $status_edr = self::edr_status('Broken Object Level Authorization',$request->method(),$request->getRequestUri(),$request->ip());
            DB::table('log_activity_microservices')
                ->where('microservice_id',$request->input('microservice_id'))
                ->where('request_by_ip',$request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);
            LogService::insert('edr',$request,null,$started,$ended,'Broken Object Level Authorization');
            return true;
        }

        return false;
    }

    private static function detectJSONInjection(Request $request,$started): bool
    {
        $data = $request->all();
        $jsonPayload = json_encode($request->input('payload_body'));
        $suspicious = false;

        // 1. JSON inside JSON (raw string mengandung objek/array)
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                // JSON object or array string
                if (preg_match('/({.*})|(\[.*\])/', $value)) {
                    $suspicious = true;
                    break;
                }

                // Escaped JSON
                if (preg_match('/\\\"({|\[).*?(}|\])\\\"/', $value)) {
                    $suspicious = true;
                    break;
                }
            }
        }

        // 2. Duplicate keys or overriding via nested key tricks
        if (preg_match_all('/"(\w+)"\s*:/', $jsonPayload, $matches)) {
            $keys = $matches[1];
            if (count($keys) !== count(array_unique($keys))) {
                // Duplicate keys found — potential override
                $suspicious = true;
            }
        }

        // 3. Dangerous characters or control sequences
        if (preg_match('/[\x00-\x1F\x7F]/', $jsonPayload)) {
            $suspicious = true;
        }

        // Jika terindikasi JSON Injection
        if ($suspicious) {
            $ended = now();
            $status_edr = self::edr_status('JSON Injection', $request->method(), $request->getRequestUri(), $request->ip());

            DB::table('log_activity_microservices')
                ->where('microservice_id', $request->input('microservice_id'))
                ->where('request_by_ip', $request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);

            LogService::insert('edr', $request, null, $started, $ended, 'JSON Injection');

            return true;
        }

        return false;
    }

    private static function detectSQLInjection(Request $request,$started): bool
    {
        $payload = json_encode($request->input('payload_body')) . ' ' . $request->getRequestUri();
        $sqli = false;

        // Daftar pola SQL injection
        $patterns = [
            // Karakter spesial umum
            '/(\%27)|(\')|(\-\-)|(\%23)|(#)/i',

            // SQL keywords
            '/(\b)(select|insert|union\s+select|update|delete|drop|truncate|exec|execute|create|alter|rename|grant|revoke|replace|having|waitfor|benchmark)(\b)/i',

            // SQL logical operators
            '/(\b)(or|and)(\b).+?=.+/i',

            // Comment-style injections
            '/(--|#|\/\*.*\*\/)/i',

            // Time-based (e.g., SLEEP)
            '/sleep\((\s*\d*\s*)\)/i',
            '/benchmark\((.*?)\,(.*?)\)/i',
            '/waitfor\s+delay/i',

            // Union select with numeric values
            '/union(\s+all)?(\s+select)?/i',

            // Encoding
            '/(%27)|(%3D)|(%2D%2D)|(%23)/i',

            // Inline subqueries
            '/(\b)(select).+?(\b)(from)(\b)/i',

            // Hex encoded attacks
            '/0x[0-9a-fA-F]+/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $payload)) {
                $sqli = true;
                break;
            }
        }

        if ($sqli){
            // Jika terindikasi SQL Injection
            $ended = now();
            $status_edr = self::edr_status('SQL Injection', $request->method(), $request->getRequestUri(), $request->ip());

            DB::table('log_activity_microservices')
                ->where('microservice_id', $request->input('microservice_id'))
                ->where('request_by_ip', $request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);

            LogService::insert('edr', $request, null, $started, $ended, 'SQL Injection');
        }

        return $sqli;
    }

    private static function detectIDOR(Request $request,$started): bool
    {
        // Jika user mencoba akses resource yang bukan miliknya
        $msId = $request->input('microservice_id');
        $authorization = $request->bearerToken();
        $accessKey  = $request->header('Access-Key');
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $msTarget = $request->input('microservice_target');

        $ms = DB::table('vw_microservice')
            ->where('microservice_id', $msId)
            ->where('microservice_path', $msPath)
            ->where('microservice_methode', strtoupper($msMethod))
            ->where('microservice_target', $msTarget)
            ->first();

        $user = DB::table('vw_user')
            ->where('jwt_token',$authorization)
            ->where('public_key',$accessKey)
            ->first();

        if ($ms->microservice_path != $msPath && $user->user_id != $ms->created_by) {
            $ended = now();
            $status_edr = self::edr_status('Insecure Direct Object Reference',$request->method(),$request->getRequestUri(),$request->ip());
            DB::table('log_activity_microservices')
                ->where('microservice_id',$request->input('microservice_id'))
                ->where('request_by_ip',$request->ip())
                ->update([
                    'response_api' => $status_edr,
                    'updated_at' => $ended
                ]);
            LogService::insert('edr',$request,null,$started,$ended,'Insecure Direct Object Reference');
            return true; // User akses ID bukan miliknya
        }
        return false;
    }

    private static function edr_status($attack,$methode,$uri,$ip): string
    {
        if ($attack != 'undetected') {
            $edr = [
                "status" => "F",
                "code" => 401,
                "message" => $attack,
                "data" => [
                    [
                        "methode" => $methode,
                        "uri_path" => $uri,
                        "ip_from" => $ip,
                        "action" => "Blacklist IP addresses"
                    ]
                ]
            ];
        } else {
            $edr = [
                "status" => "S",
                "code" => 200,
                "message" => $attack,
                "data" => [
                    [
                        "methode" => $methode,
                        "uri_path" => $uri,
                        "ip_from" => $ip,
                        "action" => ""
                    ]
                ]
            ];
        }
        return json_encode($edr);
    }
}
