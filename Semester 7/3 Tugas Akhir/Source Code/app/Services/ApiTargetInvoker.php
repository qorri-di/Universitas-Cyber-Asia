<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiTargetInvoker
{
    public static function invoke(Request $request, $created)
    {
        $ip = $request->ip();
        $pathUrl = $request->getRequestUri();
        $msMethod = $request->input('microservice_methode');
        $msTarget = $request->input('microservice_target');
        $payloadBody = $request->input('payload_body') ?? [];
        $method = strtolower($msMethod);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->$method($msTarget, $payloadBody);

            // Cek status code (2xx dianggap sukses)
            if ($response->successful()) {
                // Langsung return isi JSON dari response
                $ended = now();
                DB::table('log_activity_microservices')
                    ->where('microservice_id',$request->input('microservice_id'))
                    ->where('request_by_ip',$request->ip())
                    ->update([
                        'response_api' => json_encode($response->json()),
                        'updated_at' => $ended
                    ]);
                return response()->json($response->json(), $response->status());
            } else {
                $resp = self::status($response->status(),'Endpoint is under maintenance',$method,$pathUrl,$ip);
                $ended = now();
                DB::table('log_activity_microservices')
                    ->where('microservice_id',$request->input('microservice_id'))
                    ->where('request_by_ip',$request->ip())
                    ->update([
                        'response_api' => $resp,
                        'updated_at' => $ended
                    ]);
                return response()->json(json_decode($resp, true),$response->status());
            }

        } catch (\Throwable $e) {
            $resp = self::status(500,$e->getMessage(),$method,$pathUrl,$ip);
            $ended = now();
            DB::table('log_activity_microservices')
                ->where('microservice_id',$request->input('microservice_id'))
                ->where('request_by_ip',$request->ip())
                ->update([
                    'response_api' => $resp,
                    'updated_at' => $ended
                ]);
            return response()->json(json_decode($resp, true),$response->status());
        }
    }

    private static function status($code,$message,$method,$pathUrl,$ip):string
    {
        $api = [
            "status" => "S",
            "code" => $code,
            "message" => $message,
            "data" => [
                [
                    "methode" => $method,
                    "uri_path" => $pathUrl,
                    "ip_from" => $ip,
                    "action" => "Please wait for a response from the developer team."
                ]
            ]
        ];
        return json_encode($api);
    }
}
