<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\VisitorEvent;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|string',
            'event' => 'required|string',
        ]);

        // 1️⃣ Create or update visitor
        $visitor = Visitor::firstOrCreate(
            ['visitor_id' => $request->visitor_id],
            [
                'ip'       => $request->ip(),
                'device'   => $request->header('sec-ch-ua-mobile') ? 'mobile' : 'desktop',
                'browser'  => $request->header('User-Agent'),
                'platform' => php_uname('s'),
            ]
        );

        // 2️⃣ Store event
        VisitorEvent::create([
            'visitor_id' => $visitor->id,
            'event'      => $request->event,
            'page'       => $request->page,
            'data'       => $request->data,
        ]);

        return response()->json(['ok' => true]);
    }
}
