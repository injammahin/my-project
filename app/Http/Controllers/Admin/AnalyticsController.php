<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\VisitorEvent;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        return view('admin.analytics.dashboard', [
            
            'totalVisitors' => Visitor::count(),
            'todayVisitors' => Visitor::whereDate('created_at', today())->count(),
            'eventsToday'   => VisitorEvent::whereDate('created_at', today())->count(),
            'activeVisitors'=> Visitor::whereHas('events', function ($q) {
                $q->where('created_at', '>=', now()->subMinutes(5));
            })->count(),
            
        ]);
    }

    public function events()
    {
        $events = VisitorEvent::with('visitor')->latest()->paginate(50);
        return view('admin.analytics.events', compact('events'));
    }

    public function session($visitorId)
    {
        $visitor = Visitor::where('visitor_id', $visitorId)->firstOrFail();
        $events = $visitor->events()->orderBy('created_at')->get();

        return view('admin.analytics.session', compact('visitor', 'events'));
    }
}
