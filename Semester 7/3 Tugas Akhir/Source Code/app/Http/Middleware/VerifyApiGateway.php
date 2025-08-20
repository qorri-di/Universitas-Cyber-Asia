<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiGateway
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = ltrim($request->path(), '/'); // misalnya: api/zta/auth/login

        if (preg_match('#^api(/[^/]+)?$#', $path)) {
            return response()->json([
                'status' => 'E',
                'code' => 403,
                'message' => 'Invalid API path structure. Minimal /api/{module}/{endpoint}',
            ], Response::HTTP_FORBIDDEN);
        }

        $apiPath = '/' . substr($path, 4); // e.g. /zta/auth/login

        // Ambil semua data dari vw_microservice
        $routes = DB::table('vw_microservice')->pluck('microservice_path');

        $matched = false;
        $matchedService = null;
        foreach ($routes as $route) {
            // Match dynamic route:  /zta/user/update/{id} → ^/zta/user/update/[^/]+$
            $pattern = preg_replace('#\{[^}]+\}#', '[^/]+', $route);
            $regex = '#^' . $pattern . '$#';

            if (preg_match($regex, $apiPath)) {
                $matched = true;
                $matchedService = DB::table('vw_microservice')
                    ->where('microservice_path',$route)
                    ->first();
                break;
            }
        }

        if (!$matched) {
            $exists = DB::table('vw_microservice')
                ->where('microservice_path', $apiPath)
                ->exists();
            $matchedService = DB::table('vw_microservice')
                ->where('microservice_path',$apiPath)
                ->first();

            if (!$exists) {
                return response()->json([
                    'status' => 'E',
                    'code' => 404,
                    'message' => "API path '{$apiPath}' not registered in gateway",
                ], Response::HTTP_NOT_FOUND);
            }
        }

        // Validasi header
        $headers = array_change_key_case($request->headers->all(), CASE_LOWER);
        if (str_starts_with($path, 'api/zta')) {
            $required = ['authorization', 'access-key', 'zta-key'];
        } elseif (str_starts_with($path, 'api/no-zta')) {
            $required = ['authorization', 'access-key'];
        } else {
            return response()->json([
                'status' => 'E',
                'code' => 403,
                'message' => "Header authorization, access-key, zta-key not found",
            ], Response::HTTP_FORBIDDEN);
        }

        foreach ($required as $head) {
            if (!array_key_exists($head, $headers)) {
                return response()->json([
                    'status' => 'E',
                    'code' => 401,
                    'message' => "Header `$head` not found",
                ], Response::HTTP_UNAUTHORIZED);
            }
        }

        // Ambil payload asli
        $originalPayload = $request->all();

        // Buat struktur payload baru
        $newPayload = [
            'microservice_id' => $matchedService->microservice_id,
            'microservice_methode' => $matchedService->microservice_methode,
            'microservice_path' => $matchedService->microservice_path,
            'microservice_target' => $matchedService->microservice_target,
            'payload_body' => $originalPayload
        ];

        // Override isi request
        $request->replace($newPayload);

        return $next($request);
    }
}
