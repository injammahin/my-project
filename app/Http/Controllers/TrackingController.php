<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function store(Request $request)
    {
        $visitor = Visitor::firstOrCreate(
            ['visitor_id' => $request->visitor_id],
            [
                'ip' => $request->ip(),
                'device' => $request->header('User-Agent')
            ]
        );

        $visitor->events()->create([
            'event' => $request->event,
            'page' => $request->page,
            'data' => $request->data
        ]);

        return response()->json(['ok' => true]);
    }
}
