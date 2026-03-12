<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IpGeoService
{
    public function lookup(string $ip): array
    {
        // Don't geo lookup local IPs
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return [];
        }

        return Cache::remember("geoip:$ip", now()->addDays(7), function () use ($ip) {
            try {
                $res = Http::timeout(4)->get("https://ipapi.co/{$ip}/json/");

                if (!$res->ok()) return [];

                $geo = $res->json();

                return [
                    'country' => $geo['country_name'] ?? null,
                    'region'  => $geo['region'] ?? null,
                    'city'    => $geo['city'] ?? null,
                    'lat'     => $geo['latitude'] ?? null,
                    'lng'     => $geo['longitude'] ?? null,
                ];
            } catch (\Throwable $e) {
                return [];
            }
        });
    }
}
