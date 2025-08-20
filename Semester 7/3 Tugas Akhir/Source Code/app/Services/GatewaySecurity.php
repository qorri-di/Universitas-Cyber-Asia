<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GatewaySecurity
{
    public static function GatewayScan(Request $request,$started):bool
    {
        if (self::validateAPI($request) && self::validateToken($request)){
            LogService::insert('microservice',$request,null,$started,null,null);
            return false;
        }

        return true;
    }

    private static function validateAPI(Request $request):bool
    {
        $msId = $request->input('microservice_id');
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $msTarget = $request->input('microservice_target');

        $ms = DB::table('vw_microservice')
            ->where('microservice_id', $msId)
            ->where('microservice_path', $msPath)
            ->where('microservice_methode', strtoupper($msMethod))
            ->where('microservice_target', $msTarget)
            ->first();

        if (!$ms){
            return false;
        }

        return true;
    }

    private static function validateToken(Request $request):bool
    {
        $authorization = $request->bearerToken();
        $accessKey  = $request->header('Access-Key');

        $user = DB::table('vw_user')
            ->where('jwt_token',$authorization)
            ->where('public_key',$accessKey)
            ->first();

        if (!$user){
            return false;
        }

        return true;
    }
}
