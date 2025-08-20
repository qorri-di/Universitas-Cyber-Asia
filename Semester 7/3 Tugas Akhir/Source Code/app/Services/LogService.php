<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogService
{
    public static function insert($status,Request $request,$api_status,$created_at,$updated_at,$attacks){
        switch (strtolower($status)){
            case 'microservice':
                DB::table('log_activity_microservices')->insert([
                    'lam_id' => 'LAMID' . now()->format('YmdHis') . rand(100000000, 999999999),
                    'microservice_id' => $request->input('microservice_id'),
                    'request_body' => json_encode($request->input('payload_body')),
                    'request_by_ip' => $request->ip(),
                    'response_api' => $api_status == null ?? ' ',
                    'created_at' => $created_at,
                    'updated_at' => null
                    ]);
                break;
            case 'zta':
                $lam = DB::table('log_activity_microservices')
                    ->where('microservice_id',$request->input('microservice_id'))
                    ->where('request_by_ip',$request->ip())->first();
                $ztas = DB::table('ztas')->where('microservice_id',$request->input('microservice_id'))->first();
                DB::table('log_activity_ztas')->insert([
                    'laz_id' => 'LAZID' . now()->format('YmdHis') . rand(100000000, 999999999),
                    'lam_id' => $lam->lam_id,
                    'zta_id' => $ztas->zta_id,
                    'activity_status' => $api_status->status == 'S' ? 'Success' : 'Error',
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                ]);
                break;
            case 'edr':
                $lam = DB::table('log_activity_microservices')
                    ->where('microservice_id',$request->input('microservice_id'))
                    ->where('request_by_ip',$request->ip())->first();
                $edrs = DB::table('edrs')->where('microservice_id',$request->input('microservice_id'))->first();
                DB::table('log_activity_edrs')->insert([
                    'lae_id' => 'LAEID' . now()->format('YmdHis') . rand(100000000, 999999999),
                    'lam_id' => $lam->lam_id,
                    'edr_id' => $edrs->edr_id,
                    'attack' => $attacks,
                    'activity_status' => $attacks != 'undetected' ? 'Error' : 'Success',
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                ]);
                break;
        }
    }
}
