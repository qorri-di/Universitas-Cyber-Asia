<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZTASecurity
{
    public static function ZtaScan(Request $request):string
    {
        $started = now();
        $ztaKey = $request->header('ZTA-Key');

        $status_zta = null;
        if (!$ztaKey){
            $status_zta = self::validateKey($request);
        }

        if ($status_zta && !$status_zta->status == 'F'){
            $status_zta = self::validateZta($request);
        }

        $ended = now();
        DB::table('log_activity_microservices')
            ->where('microservice_id',$request->input('microservice_id'))
            ->where('request_by_ip',$request->ip())
            ->update([
                'response_api' => $status_zta,
                'updated_at' => $ended
            ]);
        LogService::insert('zta',$request,$status_zta,$started,$ended,null);

        return $status_zta;
    }

    private static function validateKey(Request $request):string
    {
        $msId = $request->input('microservice_id');
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $ztaKey = $request->header('ZTA-Key');

        $ztas = DB::table('ztas')
            ->where('microservice_id',$msId)
            ->first();

        $ztaTokens = DB::table('zta_tokens')
            ->where('zta_id',$ztas->zta_id)
            ->where('zta_public',$ztaKey)
            ->first();

        if (!$ztaTokens){
            $status_validateKey = self::zta_status('F',401,'ZTA Token Not Found',$msMethod,$msPath,$request->ip(),'Please check configuration user access and contact administrator');
            return $status_validateKey;
        }

        $status_validateKey = self::zta_status('S',200,'ZTA success',$msMethod,$msPath,$request->ip(),null);
        return $status_validateKey;
    }

    private static function validateZta(Request $request):string
    {
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $authorization = $request->bearerToken();
        $accessKey  = $request->header('Access-Key');

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

        if (!$user && !$usname && !$role){
            $status_validateZta = self::zta_status('F',401,'ZTA Token Not Found',$msMethod,$msPath,$request->ip(),'Please check configuration user access and contact administrator');
            return $status_validateZta;
        }

        $status_validateZta = self::zta_status('S',200,'ZTA success',$msMethod,$msPath,$request->ip(),null);

        return $status_validateZta;
    }

    private static function zta_status($status,$code,$message,$methode,$uri,$ip,$action): string
    {
        $zta = [
            "status" => $status,
            "code" => $code,
            "message" => $message,
            "data" => [
                [
                    "methode" => $methode,
                    "uri_path" => $uri,
                    "ip_from" => $ip,
                    "action" => $action
                ]
            ]
        ];
        return json_encode($zta);
    }
}
