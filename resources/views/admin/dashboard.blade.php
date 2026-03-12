@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Models\Order;
    use App\Models\OrderItem;

    // ================= KPI COUNTS =================
    $totalOrders      = Order::count();
    $pendingOrders    = Order::where('status','pending')->count();
    $processingOrders = Order::where('status','processing')->count();
    $deliveredOrders  = Order::where('status','delivered')->count();

    $today = Carbon::today();
    $todayOrders  = Order::whereDate('created_at', $today)->count();
    $weekOrders   = Order::where('created_at', '>=', $today->copy()->subDays(6)->startOfDay())->count();
    $monthOrders  = Order::where('created_at', '>=', $today->copy()->startOfMonth())->count();

    // ================= SALES (TOTAL AMOUNT) =================
    $todaySales = (float) Order::whereDate('created_at', $today)->sum('total');
    $weekSales  = (float) Order::where('created_at', '>=', $today->copy()->subDays(6)->startOfDay())->sum('total');
    $monthSales = (float) Order::where('created_at', '>=', $today->copy()->startOfMonth())->sum('total');

    $avgOrderValue = $totalOrders > 0 ? round(((float)Order::avg('total')), 2) : 0;

    $deliveredRate  = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100) : 0;
    $pendingRate    = $totalOrders > 0 ? round(($pendingOrders / $totalOrders) * 100) : 0;
    $processingRate = $totalOrders > 0 ? round(($processingOrders / $totalOrders) * 100) : 0;

    // ================= LAST 14 DAYS ORDERS + SALES =================
    $daysBack = 13;
    $start14 = $today->copy()->subDays($daysBack)->startOfDay();

    $trendRows = Order::selectRaw('DATE(created_at) as d, COUNT(*) as c, SUM(total) as s')
        ->where('created_at', '>=', $start14)
        ->groupBy('d')
        ->orderBy('d')
        ->get()
        ->keyBy('d');

    $labels = [];
    $orderSeries = [];
    $salesSeries = [];

    for ($i = $daysBack; $i >= 0; $i--) {
        $d = $today->copy()->subDays($i);
        $key = $d->format('Y-m-d');
        $labels[] = $d->format('d M');

        $row = $trendRows[$key] ?? null;
        $orderSeries[] = (int)($row->c ?? 0);
        $salesSeries[] = (float)($row->s ?? 0);
    }

    // ================= STATUS CHART =================
    $statusLabels = ['Pending', 'Processing', 'Delivered'];
    $statusData   = [$pendingOrders, $processingOrders, $deliveredOrders];

    // ================= LISTS =================
    $recentOrders = Order::latest()->take(8)->get();
    $pendingList  = Order::where('status','pending')->latest()->take(6)->get();

    // ================= TOP PRODUCTS =================
    $topProducts = OrderItem::select('product_name', DB::raw('SUM(quantity) as qty'), DB::raw('SUM(total) as sales'))
        ->groupBy('product_name')
        ->orderByDesc('qty')
        ->limit(7)
        ->get();

    // badge helper
    function badgeClass($status) {
        $s = strtolower((string)$status);
        switch ($s) {
            case 'pending':    return 'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200';
            case 'taken':      return 'bg-indigo-100 text-indigo-800 ring-1 ring-indigo-200';
            case 'processing': return 'bg-blue-100 text-blue-800 ring-1 ring-blue-200';
            case 'completed':  return 'bg-violet-100 text-violet-800 ring-1 ring-violet-200';
            case 'delivered':  return 'bg-green-100 text-green-800 ring-1 ring-green-200';
            default:           return 'bg-gray-100 text-gray-800 ring-1 ring-gray-200';
        }
    }
@endphp

<div class="space-y-6">

    {{-- ================= HERO ================= --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-lg">
        <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full blur-3xl opacity-25"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>
        <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-20"
             style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>

        <div class="relative flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/70 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-sparkles"></i>
                    Live Overview
                </div>

                <h2 class="mt-3 text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Admin Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Orders, sales, trends, and pending queue — everything in one place.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2 md:justify-end">
                <div class="inline-flex items-center gap-2 rounded-2xl bg-white/70 border border-white/60 px-4 py-2 text-sm text-gray-700 shadow-sm">
                    <i class="fa-solid fa-calendar-days"></i>
                    {{ now()->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                </div>

                <div class="inline-flex items-center gap-2 rounded-2xl bg-white/70 border border-white/60 px-4 py-2 text-sm text-gray-700 shadow-sm">
                    <i class="fa-solid fa-truck-fast"></i>
                    Delivered: <span class="font-bold">{{ $deliveredRate }}%</span>
                </div>
            </div>
        </div>

        {{-- Progress --}}
        <div class="relative mt-5">
            <div class="h-3 w-full rounded-full bg-white/70 overflow-hidden border border-white/60">
                <div class="h-full rounded-full"
                     style="width: {{ $deliveredRate }}%; background: linear-gradient(90deg, var(--button, #1f2d1f), #22c55e);"></div>
            </div>
            <div class="mt-2 text-xs text-gray-600 flex items-center gap-2">
                <i class="fa-solid fa-chart-simple"></i>
                Delivery progress based on all-time orders
            </div>
        </div>
    </div>

    {{-- ================= KPI GRID ================= --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500">Today Orders</div>
            <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ $todayOrders }}</div>
            <div class="mt-2 text-xs text-gray-500">Last 24 hours</div>
        </div>
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500">Last 7 Days</div>
            <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ $weekOrders }}</div>
            <div class="mt-2 text-xs text-gray-500">Rolling week</div>
        </div>
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500">This Month Orders</div>
            <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ $monthOrders }}</div>
            <div class="mt-2 text-xs text-gray-500">Month to date</div>
        </div>
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500">Average Order Value</div>
            <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ $avgOrderValue }}৳</div>
            <div class="mt-2 text-xs text-gray-500">All-time average</div>
        </div>
    </div>

    {{-- ================= SALES STRIP ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-coins text-amber-500"></i> Today Sales
            </div>
            <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ round($todaySales) }}৳</div>
            <div class="mt-2 text-xs text-gray-500">Total revenue today</div>
        </div>
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-blue-600"></i> 7 Days Sales
            </div>
            <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ round($weekSales) }}৳</div>
            <div class="mt-2 text-xs text-gray-500">Revenue last 7 days</div>
        </div>
        <div class="rounded-3xl border bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-calendar text-emerald-600"></i> Month Sales
            </div>
            <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ round($monthSales) }}৳</div>
            <div class="mt-2 text-xs text-gray-500">Month to date revenue</div>
        </div>
    </div>

    {{-- ================= CHARTS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="rounded-3xl border bg-white p-6 shadow-sm lg:col-span-2">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-chart-line"></i>
                        Orders (Last 14 Days)
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Daily order count trend</p>
                </div>
            </div>

            <div class="mt-5" style="height: 320px;">
                <canvas id="ordersLineChart"></canvas>
            </div>
        </div>

        <div class="rounded-3xl border bg-white p-6 shadow-sm">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie"></i>
                Status Split
            </h3>
            <p class="text-sm text-gray-600 mt-1">Pending vs Processing vs Delivered</p>

            <div class="mt-5" style="height: 240px;">
                <canvas id="statusDoughnutChart"></canvas>
            </div>

            <div class="mt-4 grid grid-cols-3 gap-2 text-center text-xs">
                <div class="rounded-2xl border bg-gray-50 p-3">
                    <div class="font-extrabold text-yellow-700">{{ $pendingRate }}%</div>
                    <div class="text-gray-500">Pending</div>
                </div>
                <div class="rounded-2xl border bg-gray-50 p-3">
                    <div class="font-extrabold text-blue-700">{{ $processingRate }}%</div>
                    <div class="text-gray-500">Processing</div>
                </div>
                <div class="rounded-2xl border bg-gray-50 p-3">
                    <div class="font-extrabold text-emerald-700">{{ $deliveredRate }}%</div>
                    <div class="text-gray-500">Delivered</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue chart --}}
    <div class="rounded-3xl border bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-sack-dollar"></i>
                    Revenue (Last 14 Days)
                </h3>
                <p class="text-sm text-gray-600 mt-1">Daily revenue trend (৳)</p>
            </div>
        </div>

        <div class="mt-5" style="height: 280px;">
            <canvas id="salesBarChart"></canvas>
        </div>
    </div>

    {{-- ================= LISTS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Pending queue --}}
        <div class="rounded-3xl border bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-hourglass-half text-yellow-600"></i>
                    Pending Queue
                </h3>
                <a href="{{ route('admin.orders.index') }}?status=pending" class="text-sm font-semibold text-blue-700 hover:underline">
                    View all →
                </a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse($pendingList as $o)
                    <div class="rounded-2xl border bg-gray-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="font-extrabold text-gray-900">#{{ $o->id }}</div>
                                <div class="text-sm font-semibold text-gray-800 truncate">
                                    {{ $o->customer_name ?? '—' }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $o->customer_phone ?? '' }} • {{ optional($o->created_at)->diffForHumans() }}
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ badgeClass($o->status) }}">
                                <i class="fa-solid fa-circle"></i> Pending
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border bg-gray-50 p-6 text-center text-gray-500">
                        No pending orders 🎉
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Top products --}}
        <div class="rounded-3xl border bg-white p-6 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-fire text-rose-600"></i>
                    Top Products
                </h3>
                <div class="text-xs text-gray-500">Most ordered items</div>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="py-2 pr-4">Product</th>
                            <th class="py-2 pr-4">Qty</th>
                            <th class="py-2 pr-0">Sales</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @forelse($topProducts as $p)
                            <tr class="border-t">
                                <td class="py-3 pr-4 font-semibold">{{ $p->product_name }}</td>
                                <td class="py-3 pr-4">{{ (int)$p->qty }}</td>
                                <td class="py-3 pr-0 font-extrabold">{{ round($p->sales) }}৳</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500">
                                    No product data yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Recent orders --}}
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-emerald-600"></i>
                        Recent Orders
                    </h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-blue-700 hover:underline">
                        View more →
                    </a>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="py-2 pr-4">#</th>
                                <th class="py-2 pr-4">Customer</th>
                                <th class="py-2 pr-4">Total</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2 pr-0">Time</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            @forelse($recentOrders as $o)
                                <tr class="border-t">
                                    <td class="py-3 pr-4 font-extrabold">#{{ $o->id }}</td>
                                    <td class="py-3 pr-4">
                                        <div class="font-semibold">{{ $o->customer_name ?? '—' }}</div>
                                        <div class="text-xs text-gray-500">{{ $o->customer_phone ?? '' }}</div>
                                    </td>
                                    <td class="py-3 pr-4 font-extrabold">{{ $o->total }}৳</td>
                                    <td class="py-3 pr-4">
                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ badgeClass($o->status) }}">
                                            <i class="fa-solid fa-circle"></i> {{ ucfirst($o->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 pr-0 text-gray-500">
                                        {{ optional($o->created_at)->timezone('Asia/Dhaka')->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">
                                        No orders yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Safety check
    if (!window.Chart) {
        console.error("Chart.js not loaded. Make sure layouts.admin has @stack('scripts')");
        return;
    }

    const labels = @json($labels);
    const orders = @json($orderSeries);
    const sales  = @json($salesSeries);

    const statusLabels = @json($statusLabels);
    const statusData   = @json($statusData);

    const css = getComputedStyle(document.documentElement);
    const primary = (css.getPropertyValue('--button') || '#1f2d1f').trim();

    // Orders line chart
    const lineEl = document.getElementById('ordersLineChart');
    if (lineEl) {
        new Chart(lineEl, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Orders',
                    data: orders,
                    tension: 0.35,
                    borderWidth: 3,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    borderColor: primary,
                    backgroundColor: 'rgba(31,45,31,0.10)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // Status doughnut
    const doughEl = document.getElementById('statusDoughnutChart');
    if (doughEl) {
        new Chart(doughEl, {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusData,
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(234,179,8,0.35)',   // pending
                        'rgba(59,130,246,0.35)',  // processing
                        'rgba(34,197,94,0.35)',   // delivered
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '68%'
            }
        });
    }

    // Sales bar chart
    const salesEl = document.getElementById('salesBarChart');
    if (salesEl) {
        new Chart(salesEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Revenue (৳)',
                    data: sales,
                    borderWidth: 1,
                    backgroundColor: 'rgba(31,45,31,0.18)',
                    borderColor: primary
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });
    }
});
</script>
@endpush
