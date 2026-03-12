@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
@php
    use Carbon\Carbon;
    use App\Models\Visitor;
    use App\Models\VisitorEvent;

    // ===== KPIs (provided from controller, but safe fallback) =====
    $totalVisitors  = $totalVisitors  ?? Visitor::count();
    $todayVisitors  = $todayVisitors  ?? Visitor::whereDate('created_at', today())->count();
    $eventsToday    = $eventsToday    ?? VisitorEvent::whereDate('created_at', today())->count();
    $activeVisitors = $activeVisitors ?? Visitor::whereHas('events', fn($q) => $q->where('created_at','>=', now()->subMinutes(5)))->count();

    // ===== 7 days charts =====
    $days = 6; // 7 days total
    $start = Carbon::today()->subDays($days)->startOfDay();

    // Visitors per day
    $vRows = Visitor::selectRaw('DATE(created_at) as d, COUNT(*) as c')
        ->where('created_at', '>=', $start)
        ->groupBy('d')->orderBy('d')
        ->pluck('c','d')->toArray();

    // Events per day
    $eRows = VisitorEvent::selectRaw('DATE(created_at) as d, COUNT(*) as c')
        ->where('created_at', '>=', $start)
        ->groupBy('d')->orderBy('d')
        ->pluck('c','d')->toArray();

    $labels = [];
    $visitorsSeries = [];
    $eventsSeries = [];

    for ($i=$days; $i>=0; $i--) {
        $d = Carbon::today()->subDays($i);
        $key = $d->format('Y-m-d');
        $labels[] = $d->format('d M');
        $visitorsSeries[] = (int)($vRows[$key] ?? 0);
        $eventsSeries[]   = (int)($eRows[$key] ?? 0);
    }

    // ===== Device split (basic) =====
    $mobileCount  = Visitor::where('device', 'mobile')->count();
    $desktopCount = Visitor::where('device', 'desktop')->count();
    $unknownCount = max(0, $totalVisitors - ($mobileCount + $desktopCount));

    // ===== Helpful mini insights =====
    $avgEventsPerVisitor = $totalVisitors > 0 ? round(VisitorEvent::count() / $totalVisitors, 2) : 0;

    // Most common pages (top 5)
    $topPages = VisitorEvent::selectRaw('page, COUNT(*) as c')
        ->whereNotNull('page')
        ->groupBy('page')
        ->orderByDesc('c')
        ->limit(5)
        ->get();
@endphp

<div class="space-y-6">

    {{-- ================= HERO HEADER ================= --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-lg">
        {{-- glow blobs --}}
        <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full blur-3xl opacity-30"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>
        <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-25"
             style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>

        <div class="relative flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/70 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    Live Analytics Overview
                </div>

                <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Analytics Dashboard
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Understand visitors, engagement, active sessions and trends — in one glance.
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-2 text-xs text-gray-600">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/70 border border-white/60 px-3 py-1.5">
                        <i class="fa-regular fa-clock"></i>
                        Updated: {{ now()->timezone('Asia/Dhaka')->format('d M, h:i A') }}
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full bg-white/70 border border-white/60 px-3 py-1.5">
                        <i class="fa-solid fa-bolt"></i>
                        Avg events/visitor: <span class="font-bold">{{ $avgEventsPerVisitor }}</span>
                    </span>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/admin/analytics/events') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-semibold border bg-white hover:bg-gray-50 transition">
                    <i class="fa-solid fa-list-check"></i>
                    Visitor Activity
                </a>

                <a href="{{ url('/admin/analytics') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-semibold text-white shadow-md hover:shadow-lg transition"
                   style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                    <i class="fa-solid fa-chart-line"></i>
                    Live Dashboard
                </a>
            </div>
        </div>
    </div>

    {{-- ================= KPI CARDS ================= --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-5 shadow-sm">
            <div class="absolute -top-10 -right-10 h-32 w-32 rounded-full blur-2xl opacity-25"
                 style="background: radial-gradient(circle, #3b82f6, transparent 70%);"></div>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">Total Visitors</p>
                    <p class="mt-2 text-2xl font-extrabold text-gray-900">{{ $totalVisitors }}</p>
                    <p class="mt-1 text-xs text-gray-500">All time</p>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-700 grid place-items-center text-xl">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-5 shadow-sm">
            <div class="absolute -top-10 -right-10 h-32 w-32 rounded-full blur-2xl opacity-25"
                 style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">Today Visitors</p>
                    <p class="mt-2 text-2xl font-extrabold text-gray-900">{{ $todayVisitors }}</p>
                    <p class="mt-1 text-xs text-gray-500">Since midnight</p>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-emerald-50 text-emerald-700 grid place-items-center text-xl">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-5 shadow-sm">
            <div class="absolute -top-10 -right-10 h-32 w-32 rounded-full blur-2xl opacity-25"
                 style="background: radial-gradient(circle, #f59e0b, transparent 70%);"></div>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">Events Today</p>
                    <p class="mt-2 text-2xl font-extrabold text-gray-900">{{ $eventsToday }}</p>
                    <p class="mt-1 text-xs text-gray-500">All actions</p>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-amber-50 text-amber-700 grid place-items-center text-xl">
                    <i class="fa-solid fa-bolt"></i>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-5 shadow-sm">
            <div class="absolute -top-10 -right-10 h-32 w-32 rounded-full blur-2xl opacity-25"
                 style="background: radial-gradient(circle, #a855f7, transparent 70%);"></div>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">Active Now</p>
                    <p class="mt-2 text-2xl font-extrabold text-gray-900">{{ $activeVisitors }}</p>
                    <p class="mt-1 text-xs text-gray-500">Last 5 minutes</p>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-violet-50 text-violet-700 grid place-items-center text-xl">
                    <i class="fa-solid fa-signal"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= CHARTS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Visitors line --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-chart-area text-emerald-600"></i>
                        Visitors Trend
                    </h3>
                    <p class="text-sm text-gray-600">Last 7 days visitors</p>
                </div>
                <div class="text-xs text-gray-500">
                    <i class="fa-regular fa-circle-dot"></i> Live
                </div>
            </div>

            <div class="mt-4" style="height: 280px;">
                <canvas id="visitorsChart"></canvas>
            </div>
        </div>

        {{-- Events + device donut --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-blue-600"></i>
                Device Split
            </h3>
            <p class="text-sm text-gray-600">Mobile vs Desktop</p>

            <div class="mt-4" style="height: 210px;">
                <canvas id="deviceChart"></canvas>
            </div>

            <div class="mt-4 grid grid-cols-3 gap-2 text-xs">
                <div class="rounded-2xl border bg-white p-3 text-center">
                    <div class="font-semibold text-gray-900">{{ $mobileCount }}</div>
                    <div class="text-gray-500">Mobile</div>
                </div>
                <div class="rounded-2xl border bg-white p-3 text-center">
                    <div class="font-semibold text-gray-900">{{ $desktopCount }}</div>
                    <div class="text-gray-500">Desktop</div>
                </div>
                <div class="rounded-2xl border bg-white p-3 text-center">
                    <div class="font-semibold text-gray-900">{{ $unknownCount }}</div>
                    <div class="text-gray-500">Unknown</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= EVENTS TREND + TOP PAGES ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Events bar --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-chart-column text-amber-600"></i>
                        Events Trend
                    </h3>
                    <p class="text-sm text-gray-600">Last 7 days events</p>
                </div>
            </div>

            <div class="mt-4" style="height: 280px;">
                <canvas id="eventsChart"></canvas>
            </div>
        </div>

        {{-- Top pages --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-violet-600"></i>
                Top Pages
            </h3>
            <p class="text-sm text-gray-600">Most visited pages</p>

            <div class="mt-4 space-y-3">
                @forelse($topPages as $p)
                    <div class="rounded-2xl border bg-white p-4">
                        <div class="text-sm font-semibold text-gray-900 truncate">
                            {{ $p->page ?? '/' }}
                        </div>
                        <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                            <span><i class="fa-solid fa-eye"></i> {{ $p->c }} hits</span>
                            <span class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                                Popular
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border bg-white p-6 text-center text-sm text-gray-500">
                        No page data yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ================= RESET (SAFER) ================= --}}
    <div class="rounded-3xl border border-red-200 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="h-12 w-12 rounded-2xl bg-red-50 text-red-700 grid place-items-center text-xl">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div>
                    <h2 class="text-lg font-extrabold text-red-700">Danger Zone: Reset Analytics</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Deletes <b>all visitors</b>, <b>all events</b>, and <b>all session history</b>.
                    </p>
                    <p class="text-xs text-red-600 mt-2 font-semibold">
                        This cannot be undone.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.analytics.reset') }}"
                  onsubmit="return confirmResetTyped()"
                  class="w-full md:w-[380px] rounded-3xl border bg-white p-5">
                @csrf
                @method('DELETE')

                <p class="text-sm font-semibold text-gray-900">Type <span class="font-extrabold text-red-600">DELETE</span> to confirm</p>
                <input id="confirmDeleteInput" type="text"
                       class="mt-3 w-full rounded-2xl border px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="DELETE" />

                <button type="submit"
                        class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-red-600 hover:bg-red-700 text-white px-5 py-3 text-sm font-semibold shadow-md">
                    <i class="fa-solid fa-trash"></i>
                    Reset All Analytics
                </button>
            </form>
        </div>
    </div>

</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    function confirmResetTyped() {
        const v = (document.getElementById('confirmDeleteInput')?.value || '').trim();
        if (v !== 'DELETE') {
            alert('Please type DELETE to confirm.');
            return false;
        }
        return confirm("⚠️ FINAL WARNING:\n\nThis will delete ALL analytics data.\n\nAre you sure?");
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (!window.Chart) return;

        const labels = @json($labels);
        const visitorsSeries = @json($visitorsSeries);
        const eventsSeries = @json($eventsSeries);

        // Read theme color from CSS variable
        const css = getComputedStyle(document.documentElement);
        const primary = (css.getPropertyValue('--button') || '#1f2d1f').trim();

        // Visitors line chart
        const vEl = document.getElementById('visitorsChart');
        if (vEl) {
            new Chart(vEl, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Visitors',
                        data: visitorsSeries,
                        borderColor: primary,
                        backgroundColor: 'rgba(31,45,31,0.10)',
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Events bar chart
        const eEl = document.getElementById('eventsChart');
        if (eEl) {
            new Chart(eEl, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Events',
                        data: eventsSeries,
                        borderWidth: 1,
                        backgroundColor: 'rgba(245,158,11,0.35)',
                        borderColor: 'rgba(245,158,11,0.9)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Device donut
        const dEl = document.getElementById('deviceChart');
        if (dEl) {
            new Chart(dEl, {
                type: 'doughnut',
                data: {
                    labels: ['Mobile', 'Desktop', 'Unknown'],
                    datasets: [{
                        data: [{{ (int)$mobileCount }}, {{ (int)$desktopCount }}, {{ (int)$unknownCount }}],
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    cutout: '68%'
                }
            });
        }
    });
</script>
@endsection
