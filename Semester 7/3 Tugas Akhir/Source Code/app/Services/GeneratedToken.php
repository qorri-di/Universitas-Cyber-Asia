<?php

namespace App\Services;

use Illuminate\Support\Str;

class GeneratedToken
{
    public static function jwtEncode($userid): string
    {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode([
            'id' => $userid,
            'sub' => Str::uuid(),
            'exp' => now()->addDays(30)->timestamp,
        ]));
        $signature = hash_hmac('sha256', "$header.$payload", 'secret_key', true);
        $signatureB64 = str_replace(['+', '/', '='], ['', '', ''], base64_encode($signature));

        return "$header.$payload.$signatureB64";
    }

    public static function jwtDecode(string $token): bool
    {
        $parts = explode('.', $token);

        // Token harus memiliki 3 bagian
        if (count($parts) !== 3) {
            return false;
        }

        [$header, $payload, $signature] = $parts;

        // Hitung ulang signature berdasarkan secret_key
        $expectedSignature = base64_encode(hash_hmac('sha256', "$header.$payload", 'secret_key', true));
        $expectedSignature = str_replace(['+', '/', '='], ['', '', ''], $expectedSignature);

        // Bandingkan signature
        if (!hash_equals($expectedSignature, $signature)) {
            return false;
        }

        // Decode payload
        $decodedPayload = json_decode(base64_decode($payload), true);

        // Pastikan struktur payload valid
        if (!is_array($decodedPayload) || !isset($decodedPayload['exp'])) {
            return false;
        }

        // Cek waktu expired
        if (now()->timestamp > $decodedPayload['exp']) {
            return false;
        }

        // Jika valid, return payload
        return true;
    }

    public static function access($userid): string
    {
        return hash('sha256', $userid);
    }

    public static function apiScreate($userid): string
    {
        return Str::random(32);
    }

    public static function ztaScreate($userid): string
    {
        return Str::random(64);
    }
}
