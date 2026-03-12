<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\VisitorEvent;
use App\Services\GeoIpService;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function store(Request $request, GeoIpService $geo)
    {
        $request->validate([
            'visitor_id' => 'required|string',
            'event'      => 'required|string',
            'page'       => 'nullable|string',
            'data'       => 'nullable',
        ]);

        // Real IP (behind proxy needs TrustProxies config - see below)
        $ip = $request->ip();

        $visitor = Visitor::firstOrCreate(
            ['visitor_id' => $request->visitor_id],
            [
                'ip'       => $ip,
                'device'   => $request->header('sec-ch-ua-mobile') ? 'mobile' : 'desktop',
                'browser'  => $request->header('User-Agent'),
                'platform' => null, // don't use php_uname(), that's server OS
            ]
        );

        // Update IP if changed
        if ($visitor->ip !== $ip) {
            $visitor->ip = $ip;
        }

        // If geo missing -> lookup once and save
        if (empty($visitor->lat) || empty($visitor->lng) || empty($visitor->city)) {
            $geoData = $geo->lookup($visitor->ip);
            if ($geoData) {
                $visitor->country = $geoData['country'];
                $visitor->region  = $geoData['region'];
                $visitor->city    = $geoData['city'];
                $visitor->lat     = $geoData['lat'];
                $visitor->lng     = $geoData['lng'];
            }
        }

        $visitor->save();

        VisitorEvent::create([
            'visitor_id' => $visitor->id,
            'event'      => $request->event,
            'page'       => $request->page,
            'data'       => $request->data,
        ]);

        return response()->json(['ok' => true]);
    }
}
