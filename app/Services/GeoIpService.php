<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeoIpService
{
    public function lookup(?string $ip): ?array
    {
        if (!$ip) return null;

        // Skip localhost/private/reserved IPs
        if (!$this->isPublicIp($ip)) return null;

        return Cache::remember("geoip:$ip", now()->addDays(30), function () use ($ip) {

            // ip-api.com is simple & free (rate limited). Use paid service if high traffic.
            $url = "http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,lat,lon,query";

            $res = Http::timeout(5)->get($url);

            if (!$res->ok()) return null;

            $json = $res->json();

            if (($json['status'] ?? '') !== 'success') {
                return null;
            }

            return [
                'country' => $json['country'] ?? null,
                'region'  => $json['regionName'] ?? null,
                'city'    => $json['city'] ?? null,
                'lat'     => $json['lat'] ?? null,
                'lng'     => $json['lon'] ?? null,
                'ip'      => $json['query'] ?? $ip,
            ];
        });
    }

    private function isPublicIp(string $ip): bool
    {
        // FILTER_FLAG_NO_PRIV_RANGE + FILTER_FLAG_NO_RES_RANGE = public only
        return (bool) filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }
}
