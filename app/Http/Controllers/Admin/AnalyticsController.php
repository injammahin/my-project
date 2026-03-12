<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\VisitorEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;
class AnalyticsController extends Controller
{
    /**
     * DASHBOARD
     */
    public function dashboard()
    {
        return view('admin.analytics.dashboard', [

            'totalVisitors' => Visitor::count(),

            'todayVisitors' => Visitor::whereDate('created_at', today())->count(),

            'eventsToday'   => VisitorEvent::whereDate('created_at', today())->count(),

            // Active in last 5 minutes
            'activeVisitors'=> Visitor::whereHas('events', function ($q) {
                $q->where('created_at', '>=', now()->subMinutes(5));
            })->count(),

        ]);
    }

    public function events(Request $request)
    {
        $q     = trim((string) $request->get('q', ''));
        $event = (string) $request->get('event', 'all');
        $range = (string) $request->get('range', 'all');

        // Base query (we will reuse it)
        $base = VisitorEvent::query();

        if ($event !== 'all' && $event !== '') {
            $base->where('event', $event);
        }

        if ($range === 'today') {
            $base->whereDate('created_at', today());
        } elseif ($range === '7d') {
            $base->where('created_at', '>=', now()->subDays(7));
        } elseif ($range === '30d') {
            $base->where('created_at', '>=', now()->subDays(30));
        }

        if ($q !== '') {
            $base->where(function ($w) use ($q) {
                $w->where('page', 'like', "%{$q}%")
                ->orWhere('event', 'like', "%{$q}%")
                ->orWhereHas('visitor', function ($v) use ($q) {
                    $v->where('visitor_id', 'like', "%{$q}%")
                        ->orWhere('ip', 'like', "%{$q}%")
                        ->orWhere('device', 'like', "%{$q}%")
                        ->orWhere('browser', 'like', "%{$q}%");
                });
            });
        }

        // latest event time per visitor (AFTER filters)
        $latestPerVisitor = (clone $base)
            ->select('visitor_id', DB::raw('MAX(created_at) as last_event_time'))
            ->groupBy('visitor_id');

        $events = VisitorEvent::with('visitor')
            ->joinSub($latestPerVisitor, 'latest', function ($join) {
                $join->on('visitor_events.visitor_id', '=', 'latest.visitor_id')
                    ->on('visitor_events.created_at', '=', 'latest.last_event_time');
            })
            ->orderByDesc('visitor_events.created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.analytics.events', compact('events'));
    }

    /**
     * VISITOR SESSION (FULL TIMELINE)
     */
    public function session(string $visitorId)
    {
        $visitor = Visitor::where('visitor_id', $visitorId)->firstOrFail();

        $events = $visitor->events()
            ->orderBy('created_at')
            ->limit(200)
            ->get();

        // ✅ prevent 500 if orders.visitor_id doesn't exist
        $lastOrder = null;
        if (Schema::hasColumn('orders', 'visitor_id')) {
            $lastOrder = Order::where('visitor_id', $visitorId)->latest()->first();
        }

        return view('admin.analytics.session', compact('visitor', 'events', 'lastOrder'));
    }

    /**
     * DELETE / RESET ALL ANALYTICS (ADMIN ONLY)
     */
    public function reset()
    {
        DB::transaction(function () {
            DB::table('visitor_events')->delete();
            DB::table('visitors')->delete();
        });

        return redirect('/admin/analytics')
            ->with('success', 'All analytics data has been cleared successfully.');
    }
    public function map()
    {
        $points = Visitor::query()
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->latest()
            ->limit(2000)
            ->get(['visitor_id','ip','device','browser','country','region','city','lat','lng','created_at']);

        $cityStats = Visitor::select('city', DB::raw('COUNT(*) as total'))
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.analytics.map', compact('points', 'cityStats'));
    }


}
