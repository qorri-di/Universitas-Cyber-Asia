<?php

namespace App\Http\Controllers;

use App\Services\ApiTargetInvoker;
use App\Services\EDRSecurity;
use App\Services\GatewaySecurity;
use App\Services\ZTASecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiGatewayController
{
    public function handle(Request $request)
    {
        $started= now();
        $msId = $request->input('microservice_id');
        $msPath = $request->input('microservice_path');
        $msMethod = $request->input('microservice_methode');
        $msTarget = $request->input('microservice_target');

        $service = DB::table('vw_microservice')
            ->where('microservice_id', $msId)
            ->where('microservice_path', $msPath)
            ->where('microservice_methode', strtoupper($msMethod))
            ->where('microservice_target', $msTarget)
            ->first();

        if (!$service) {
            return response()->json([
                'status' => 'E',
                'code' => 404,
                'message' => 'Microservice not found or misconfigured.',
            ], Response::HTTP_NOT_FOUND);
        }

        $api_status = null;
        // ✅ 1. GATEWAY SECURITY
        if ($service->gateway_status == 'ACTIVE' && GatewaySecurity::GatewayScan($request,$started)) {

            // ✅ 2. ZTA SECURITY
            if ($service->zta_status == 'ACTIVE') {
                $api_status = ZTASecurity::ZtaScan($request);
            }

            // ✅ 3. EDR SECURITY
            if ($service->edr_status == 'ACTIVE') {
                $api_status = EDRSecurity::EdrScan($request,$started);
            }
        }

        // ✅ Lolos semua security, lanjutkan request
        if ($api_status && $api_status->status != 'F') {
            ApiTargetInvoker::invoke($request,$started);
        }

        return response()->json(json_decode($api_status,true),$api_status->code);
    }
}
