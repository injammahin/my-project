@extends('layouts.admin')

@section('title', 'Visitor Session')

@section('content')
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    // Events are usually ordered ASC in controller (timeline)
    $events = $events ?? collect();

    // Key steps
    $hasCart     = $events->contains('event', 'add_to_cart');
    $hasCheckout = $events->contains('event', 'checkout_start');
    $hasPurchase = $events->contains('event', 'purchase');

    // Counts
    $pageViews   = $events->where('event','page_view')->count();
    $cartAdds    = $events->where('event','add_to_cart')->count();
    $scrolls     = $events->where('event','scroll_depth')->count();
    $exits       = $events->where('event','exit_intent')->count();

    // Max scroll percent
    $maxScroll = 0;
    foreach ($events->where('event','scroll_depth') as $ev) {
        $d = $ev->data;
        if (is_string($d)) {
            $tmp = json_decode($d, true);
            if (json_last_error() === JSON_ERROR_NONE) $d = $tmp;
        }
        if (is_array($d) && isset($d['percent'])) {
            $maxScroll = max($maxScroll, (int)$d['percent']);
        }
    }

    // Time on page (best-effort)
    $timeOnPageSeconds = null;
    $timeEv = $events->where('event','time_on_page')->last();
    if ($timeEv) {
        $d = $timeEv->data;
        if (is_string($d)) {
            $tmp = json_decode($d, true);
            if (json_last_error() === JSON_ERROR_NONE) $d = $tmp;
        }
        if (is_array($d) && isset($d['seconds'])) $timeOnPageSeconds = (int)$d['seconds'];
    }

    $formatSeconds = function ($sec) {
        if ($sec === null) return '—';
        $m = intdiv($sec, 60);
        $s = $sec % 60;
        if ($m <= 0) return $s . ' sec';
        return $m . ' min ' . str_pad((string)$s, 2, '0', STR_PAD_LEFT) . ' sec';
    };

    // First/Last seen
    $firstAt = optional($events->first())->created_at;
    $lastAt  = optional($events->last())->created_at;

    // Friendly result text (drop-off)
    if ($hasPurchase) {
        $resultTitle = 'Purchase completed ✅';
        $resultNote  = 'This visitor successfully finished the order.';
        $resultClass = 'bg-emerald-50 border-emerald-200 text-emerald-900';
        $resultIcon  = 'fa-solid fa-circle-check';
    } else {
        if ($hasCheckout) {
            $resultTitle = 'Left during checkout ⚠️';
            $resultNote  = 'They started checkout but did not finish the order.';
        } elseif ($hasCart) {
            $resultTitle = 'Left after adding to cart ⚠️';
            $resultNote  = 'They added items to cart but did not go to checkout.';
        } else {
            $resultTitle = 'Browsed only 👀';
            $resultNote  = 'They looked around but did not add anything to cart.';
        }
        $resultClass = 'bg-amber-50 border-amber-200 text-amber-900';
        $resultIcon  = 'fa-solid fa-triangle-exclamation';
    }

    // Pull last order for this visitor (optional, only if you save visitor_id on orders)
    $lastOrder = \App\Models\Order::where('visitor_id', $visitor->visitor_id)->latest()->first();

    // Helper: event display mapping
    $eventMap = [
        'page_view'      => ['title'=>'Visited the website',       'desc'=>'Opened a page',                 'icon'=>'fa-regular fa-file-lines',  'chip'=>'bg-blue-50 text-blue-700 ring-1 ring-blue-100'],
        'scroll_depth'   => ['title'=>'Scrolled',                  'desc'=>'Moved down the page',          'icon'=>'fa-solid fa-arrow-down',    'chip'=>'bg-indigo-50 text-indigo-700 ring-1 ring-indigo-100'],
        'add_to_cart'    => ['title'=>'Added to cart',             'desc'=>'Picked a product',             'icon'=>'fa-solid fa-cart-shopping', 'chip'=>'bg-amber-50 text-amber-800 ring-1 ring-amber-100'],
        'checkout_start' => ['title'=>'Started checkout',          'desc'=>'Began order process',          'icon'=>'fa-regular fa-credit-card', 'chip'=>'bg-violet-50 text-violet-700 ring-1 ring-violet-100'],
        'purchase'       => ['title'=>'Order placed',              'desc'=>'Completed purchase',           'icon'=>'fa-solid fa-sack-dollar',   'chip'=>'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100'],
        'exit_intent'    => ['title'=>'Tried to leave',            'desc'=>'Moved mouse to close/leave',   'icon'=>'fa-regular fa-circle-xmark','chip'=>'bg-rose-50 text-rose-700 ring-1 ring-rose-100'],
        'form_start'     => ['title'=>'Started typing in form',    'desc'=>'Began entering details',       'icon'=>'fa-regular fa-pen-to-square','chip'=>'bg-sky-50 text-sky-700 ring-1 ring-sky-100'],
        'time_on_page'   => ['title'=>'Time spent on site',        'desc'=>'How long they stayed',         'icon'=>'fa-regular fa-clock',       'chip'=>'bg-gray-50 text-gray-700 ring-1 ring-gray-100'],
    ];

    // Chart data (simple)
    $chartLabels = ['Page Views','Cart Adds','Checkout','Purchase','Exit Intent'];
    $chartData   = [
        $pageViews,
        $cartAdds,
        $events->where('event','checkout_start')->count(),
        $events->where('event','purchase')->count(),
        $exits
    ];
@endphp

<div class="space-y-6">

    {{-- HERO --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-xl">
        <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full blur-3xl opacity-30"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>
        <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full blur-3xl opacity-20"
             style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>

        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/70 border border-white/60 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-user-clock"></i>
                    Visitor Session
                </div>

                <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    One Visitor’s Activity
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Visitor ID: <span class="font-semibold">{{ Str::limit($visitor->visitor_id, 20) }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <button type="button"
                        class="inline-flex items-center gap-2 rounded-2xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-gray-50"
                        onclick="copyText('{{ $visitor->visitor_id }}')">
                    <i class="fa-regular fa-copy"></i>
                    Copy Visitor ID
                </button>

                <a href="{{ url('/admin/analytics/events') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-gray-50">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        {{-- Small “story” line --}}
        <div class="mt-5 grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="rounded-2xl border bg-white/70 p-4">
                <div class="text-xs text-gray-500">First seen</div>
                <div class="mt-1 font-bold text-gray-900">
                    {{ $firstAt ? $firstAt->format('d M Y, h:i A') : '—' }}
                </div>
            </div>
            <div class="rounded-2xl border bg-white/70 p-4">
                <div class="text-xs text-gray-500">Last seen</div>
                <div class="mt-1 font-bold text-gray-900">
                    {{ $lastAt ? $lastAt->format('d M Y, h:i A') : '—' }}
                </div>
            </div>
            <div class="rounded-2xl border bg-white/70 p-4">
                <div class="text-xs text-gray-500">Time spent (approx.)</div>
                <div class="mt-1 font-bold text-gray-900">
                    {{ $formatSeconds($timeOnPageSeconds) }}
                </div>
            </div>
        </div>
    </div>

    {{-- RESULT / WHERE THEY STOPPED --}}
    <div class="rounded-3xl border p-5 {{ $resultClass }}">
        <div class="flex items-start gap-3">
            <div class="w-11 h-11 rounded-2xl bg-white/70 border grid place-items-center">
                <i class="{{ $resultIcon }} text-lg"></i>
            </div>
            <div class="min-w-0">
                <div class="font-extrabold text-lg">{{ $resultTitle }}</div>
                <div class="text-sm opacity-90 mt-1">{{ $resultNote }}</div>
            </div>
        </div>
    </div>

    {{-- CONTACT (if they ordered) + VISITOR INFO --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Contact / Order --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <h3 class="font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-emerald-600"></i>
                Customer Info
            </h3>
            <p class="text-xs text-gray-500 mt-1">
                Shown only if the visitor placed an order.
            </p>

            @if($lastOrder)
                <div class="mt-5 space-y-3">
                    <div class="rounded-2xl bg-white border p-4">
                        <div class="text-xs text-gray-500">Name</div>
                        <div class="font-bold text-gray-900 mt-1">
                            {{ $lastOrder->customer_name ?? $lastOrder->name ?? '—' }}
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border p-4">
                        <div class="text-xs text-gray-500">Phone</div>
                        <div class="font-bold text-gray-900 mt-1">
                            {{ $lastOrder->customer_phone ?? $lastOrder->phone ?? '—' }}
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border p-4">
                        <div class="text-xs text-gray-500">Address</div>
                        <div class="font-semibold text-gray-900 mt-1">
                            {{ $lastOrder->address ?? '—' }}
                        </div>
                    </div>

                    <a href="{{ url('/admin/orders/'.$lastOrder->id) }}"
                       class="inline-flex items-center justify-center gap-2 w-full mt-2 rounded-2xl px-4 py-3 text-white font-semibold shadow-md hover:shadow-lg transition"
                       style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                        <i class="fa-solid fa-receipt"></i>
                        Open Order
                    </a>
                </div>
            @else
                <div class="mt-5 rounded-2xl border bg-white p-5 text-sm text-gray-600">
                    No order is linked to this visitor yet.
                </div>
            @endif
        </div>

        {{-- Visitor basics --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm lg:col-span-2">
            <h3 class="font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-600"></i>
                Visitor Basics
            </h3>
            <p class="text-xs text-gray-500 mt-1">
                Helpful context for understanding who they are (device + browser).
            </p>

            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-white border p-4">
                    <div class="text-xs text-gray-500">IP Address</div>
                    <div class="font-bold text-gray-900 mt-1">{{ $visitor->ip ?? '—' }}</div>
                </div>

                <div class="rounded-2xl bg-white border p-4">
                    <div class="text-xs text-gray-500">Device</div>
                    <div class="font-bold text-gray-900 mt-1">{{ $visitor->device ?? '—' }}</div>
                </div>

                <div class="rounded-2xl bg-white border p-4 sm:col-span-2">
                    <div class="text-xs text-gray-500">Browser / User Agent</div>
                    <div class="font-semibold text-gray-900 mt-1 break-words">
                        {{ $visitor->browser ?? '—' }}
                    </div>
                </div>
            </div>

            {{-- Simple KPI chips --}}
            <div class="mt-5 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-blue-50 text-blue-700 ring-1 ring-blue-100">
                    <i class="fa-regular fa-file-lines"></i> Page views: {{ $pageViews }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-amber-50 text-amber-800 ring-1 ring-amber-100">
                    <i class="fa-solid fa-cart-shopping"></i> Cart adds: {{ $cartAdds }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 ring-1 ring-indigo-100">
                    <i class="fa-solid fa-arrow-down"></i> Max scroll: {{ $maxScroll }}%
                </span>

                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-gray-50 text-gray-700 ring-1 ring-gray-100">
                    <i class="fa-regular fa-clock"></i> Time: {{ $formatSeconds($timeOnPageSeconds) }}
                </span>
            </div>
        </div>
    </div>

    {{-- JOURNEY (NON-TECHNICAL) --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <h3 class="font-extrabold text-gray-900 flex items-center gap-2">
            <i class="fa-solid fa-route text-violet-600"></i>
            Simple Journey (Step by step)
        </h3>
        <p class="text-xs text-gray-500 mt-1">
            Green means the visitor completed that step.
        </p>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="rounded-2xl border bg-white p-4">
                <div class="flex items-center justify-between">
                    <div class="font-bold text-gray-900">Visit</div>
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                </div>
                <div class="text-xs text-gray-500 mt-1">Opened the website</div>
            </div>

            <div class="rounded-2xl border bg-white p-4">
                <div class="flex items-center justify-between">
                    <div class="font-bold text-gray-900">Cart</div>
                    <i class="{{ $hasCart ? 'fa-solid fa-circle-check text-emerald-600' : 'fa-regular fa-circle text-gray-300' }}"></i>
                </div>
                <div class="text-xs text-gray-500 mt-1">Added a product</div>
            </div>

            <div class="rounded-2xl border bg-white p-4">
                <div class="flex items-center justify-between">
                    <div class="font-bold text-gray-900">Checkout</div>
                    <i class="{{ $hasCheckout ? 'fa-solid fa-circle-check text-emerald-600' : 'fa-regular fa-circle text-gray-300' }}"></i>
                </div>
                <div class="text-xs text-gray-500 mt-1">Started ordering</div>
            </div>

            <div class="rounded-2xl border bg-white p-4">
                <div class="flex items-center justify-between">
                    <div class="font-bold text-gray-900">Order</div>
                    <i class="{{ $hasPurchase ? 'fa-solid fa-circle-check text-emerald-600' : 'fa-regular fa-circle text-gray-300' }}"></i>
                </div>
                <div class="text-xs text-gray-500 mt-1">Placed the order</div>
            </div>
        </div>
    </div>

    {{-- SIMPLE GRAPH (Optional) --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-chart-column text-emerald-600"></i>
                    What they did (simple chart)
                </h3>
                <p class="text-xs text-gray-500 mt-1">A quick overview of actions.</p>
            </div>
        </div>

        <div class="mt-5" style="height: 260px;">
            <canvas id="sessionActionChart"></canvas>
        </div>

        <div class="mt-4 text-xs text-gray-500">
            If chart doesn’t show, confirm <span class="font-semibold">@stack('scripts')</span> exists in layout.
        </div>
    </div>

    {{-- TIMELINE --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-white/60 flex items-center justify-between">
            <div class="font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-blue-600"></i>
                Activity Timeline
            </div>
            <div class="text-xs text-gray-500">
                Total actions: {{ $events->count() }}
            </div>
        </div>

        <div class="divide-y divide-white/60">
            @forelse($events as $e)
                @php
                    $meta = $eventMap[$e->event] ?? [
                        'title' => 'Activity',
                        'desc'  => 'Visitor did something',
                        'icon'  => 'fa-regular fa-circle',
                        'chip'  => 'bg-gray-50 text-gray-700 ring-1 ring-gray-100'
                    ];

                    $data = $e->data;
                    if (is_string($data)) {
                        $tmp = json_decode($data, true);
                        if (json_last_error() === JSON_ERROR_NONE) $data = $tmp;
                    }

                    $prettyTime = $e->created_at ? $e->created_at->format('d M, h:i A') : '';
                @endphp

                <div class="px-6 py-4">
                    <div class="flex items-start gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-white border grid place-items-center">
                            <i class="{{ $meta['icon'] }} text-gray-800"></i>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 justify-between">
                                <div class="min-w-0">
                                    <div class="font-bold text-gray-900">{{ $meta['title'] }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $meta['desc'] }}</div>
                                </div>

                                <div class="text-xs text-gray-400 whitespace-nowrap">
                                    {{ $prettyTime }}
                                </div>
                            </div>

                            {{-- Friendly extras --}}
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $meta['chip'] }}">
                                    <i class="fa-solid fa-tag"></i>
                                    {{ $e->event }}
                                </span>

                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-gray-50 text-gray-700 ring-1 ring-gray-100 max-w-full">
                                    <i class="fa-solid fa-link"></i>
                                    <span class="truncate max-w-[520px]">{{ $e->page ?? '/' }}</span>
                                </span>
                            </div>

                            {{-- Details (only if exists) --}}
                            @if(!empty($data))
                                <details class="mt-3">
                                    <summary class="cursor-pointer text-sm font-semibold text-blue-700 hover:underline">
                                        Show details
                                    </summary>
                                    <pre class="mt-2 text-xs leading-relaxed bg-gray-50 border rounded-2xl p-4 overflow-auto max-h-[45vh]">{{ json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                </details>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-gray-500">
                    No activity recorded.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        function copyText(txt) {
            txt = txt || '';
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(txt);
                return;
            }
            const ta = document.createElement('textarea');
            ta.value = txt;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            ta.remove();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('sessionActionChart');
            if (!el || !window.Chart) return;

            const labels = @json($chartLabels);
            const data   = @json($chartData);

            // Use your theme primary color if available
            const css = getComputedStyle(document.documentElement);
            const primary = (css.getPropertyValue('--button') || '#1f2d1f').trim();

            new Chart(el, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Count',
                        data,
                        borderWidth: 1,
                        backgroundColor: primary + '22',
                        borderColor: primary
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
@endpush
