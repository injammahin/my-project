@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')
@php
    $status = strtolower($order->status ?? 'pending');

    $badge = match ($status) {
        'pending'    => 'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200',
        'taken'      => 'bg-indigo-100 text-indigo-800 ring-1 ring-indigo-200',
        'processing' => 'bg-blue-100 text-blue-800 ring-1 ring-blue-200',
        'completed'  => 'bg-violet-100 text-violet-800 ring-1 ring-violet-200',
        'delivered'  => 'bg-emerald-100 text-emerald-800 ring-1 ring-emerald-200',
        default      => 'bg-gray-100 text-gray-800 ring-1 ring-gray-200',
    };

    $statusSteps = [
        'pending'    => ['label' => 'Pending',    'icon' => 'fa-solid fa-hourglass-half'],
        'taken'      => ['label' => 'Taken',      'icon' => 'fa-solid fa-hand-holding'],
        'processing' => ['label' => 'Processing', 'icon' => 'fa-solid fa-gears'],
        'completed'  => ['label' => 'Completed',  'icon' => 'fa-solid fa-circle-check'],
        'delivered'  => ['label' => 'Delivered',  'icon' => 'fa-solid fa-truck-fast'],
    ];

    // Find current step index
    $stepKeys = array_keys($statusSteps);
    $currentIndex = array_search($status, $stepKeys);
    if ($currentIndex === false) $currentIndex = 0;

    $itemsCount = $order->items?->sum('quantity') ?? 0;

    // Safety if created_at is null
    $createdAt = optional($order->created_at);
@endphp

{{-- ✅ SUCCESS TOAST --}}
@if(session('success'))
    <div id="toast"
         class="fixed top-6 right-6 z-50 bg-gray-900 text-white px-5 py-4 rounded-2xl shadow-2xl
                text-sm flex items-center gap-3 animate-slide-in">
        <span class="w-9 h-9 rounded-2xl bg-emerald-500/20 text-emerald-300 grid place-items-center">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        <div class="leading-tight">
            <div class="font-semibold">Success</div>
            <div class="text-white/80">{{ session('success') }}</div>
        </div>
    </div>
@endif

<div class="max-w-5xl mx-auto space-y-6">

    {{-- ================= HERO HEADER ================= --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-lg">
        {{-- glow blobs --}}
        <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full blur-3xl opacity-25"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>
        <div class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full blur-3xl opacity-20"
             style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>

        <div class="relative flex flex-col md:flex-row md:items-start md:justify-between gap-5">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/70 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-receipt"></i>
                    Order Details
                </div>

                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Order #{{ $order->id }}
                    </h2>

                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $badge }}">
                        <i class="fa-solid fa-circle"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-600">
                    <span class="inline-flex items-center gap-2 rounded-full border bg-white px-3 py-1.5">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $createdAt->timezone('Asia/Dhaka')->format('d M Y, h:i A') ?: '—' }}
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full border bg-white px-3 py-1.5">
                        <i class="fa-solid fa-cubes"></i>
                        Items: <span class="font-semibold">{{ $itemsCount }}</span>
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full border bg-white px-3 py-1.5">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Total: <span class="font-semibold">{{ $order->total }}৳</span>
                    </span>
                </div>
            </div>

            {{-- Quick buttons --}}
            <div class="flex flex-wrap gap-2 md:justify-end">
                <button type="button"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl border bg-white hover:bg-gray-50 text-sm font-semibold"
                        onclick="copyText('Order #{{ $order->id }}')">
                    <i class="fa-regular fa-copy"></i>
                    Copy Order ID
                </button>

                <button type="button"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-white text-sm font-semibold shadow-md hover:shadow-lg transition"
                        style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);"
                        onclick="window.print()">
                    <i class="fa-solid fa-print"></i>
                    Print
                </button>
            </div>
        </div>
    </div>

    {{-- ================= STATUS TIMELINE ================= --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-route text-emerald-600"></i>
                Order Progress
            </h3>
            <div class="text-xs text-gray-500">Current: <span class="font-semibold">{{ ucfirst($order->status) }}</span></div>
        </div>

        <div class="mt-5 grid grid-cols-1 md:grid-cols-5 gap-3">
            @foreach($statusSteps as $key => $meta)
                @php
                    $i = array_search($key, $stepKeys);
                    $done = $i !== false && $i <= $currentIndex;
                @endphp

                <div class="rounded-2xl border bg-white p-4">
                    <div class="flex items-center gap-3">
                        <span class="h-10 w-10 rounded-2xl grid place-items-center
                                     {{ $done ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-50 text-gray-500' }}">
                            <i class="{{ $meta['icon'] }}"></i>
                        </span>

                        <div class="min-w-0">
                            <div class="text-sm font-bold text-gray-900">{{ $meta['label'] }}</div>
                            <div class="text-xs {{ $done ? 'text-emerald-600' : 'text-gray-500' }}">
                                {{ $done ? 'Done' : 'Pending' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ================= CUSTOMER + ACTIONS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Customer card --}}
        <div class="lg:col-span-2 rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-user text-blue-600"></i>
                    Customer Information
                </h3>

                <span class="text-xs text-gray-500">
                    Keep this data private
                </span>
            </div>

            <div class="mt-5 grid sm:grid-cols-2 gap-5 text-sm">
                <div class="rounded-2xl border bg-white p-4">
                    <p class="text-xs text-gray-500">Name</p>
                    <p class="mt-1 font-semibold text-gray-900">{{ $order->customer_name }}</p>
                </div>

                <div class="rounded-2xl border bg-white p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs text-gray-500">Phone</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <button class="text-xs font-semibold px-3 py-2 rounded-xl border bg-white hover:bg-gray-50"
                                onclick="copyText('{{ $order->customer_phone }}')">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="sm:col-span-2 rounded-2xl border bg-white p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-xs text-gray-500">Address</p>
                            <p class="mt-1 font-semibold text-gray-900 break-words">{{ $order->customer_address }}</p>
                        </div>
                        <button class="text-xs font-semibold px-3 py-2 rounded-xl border bg-white hover:bg-gray-50"
                                onclick="copyText(@json($order->customer_address))">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Optional note --}}
            <div class="mt-5 rounded-2xl border bg-white p-4">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Note</div>
                <div class="mt-2 text-sm text-gray-700">
                    You can add internal notes here (e.g. delivery instructions, call status, etc.).
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-bolt text-amber-600"></i>
                Quick Actions
            </h3>

            <div class="mt-4 grid gap-3">
                <a class="inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold text-white shadow-md hover:shadow-lg transition"
                   style="background: linear-gradient(90deg, #16a34a, #22c55e);"
                   href="tel:{{ $order->customer_phone }}">
                    <i class="fa-solid fa-phone"></i>
                    Call Customer
                </a>

                <a class="inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold text-white shadow-md hover:shadow-lg transition"
                   style="background: linear-gradient(90deg, #0ea5e9, #2563eb);"
                   target="_blank"
                   href="https://wa.me/{{ preg_replace('/\D+/', '', $order->customer_phone) }}">
                    <i class="fa-brands fa-whatsapp"></i>
                    WhatsApp
                </a>

                <a class="inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold border bg-white hover:bg-gray-50 transition"
                   target="_blank"
                   href="https://www.google.com/maps/search/?api=1&query={{ urlencode($order->customer_address) }}">
                    <i class="fa-solid fa-location-dot text-red-600"></i>
                    Open in Google Maps
                </a>
            </div>

            <div class="mt-5 rounded-2xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900">
                <div class="font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i>
                    Tip
                </div>
                <div class="mt-1 text-xs">
                    Mark “Taken” right after you confirm the customer by phone.
                </div>
            </div>
        </div>
    </div>

    {{-- ================= ORDER ITEMS ================= --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-box-open text-emerald-600"></i>
                Ordered Products
            </h3>

            <div class="text-xs text-gray-500">
                {{ $order->items->count() }} products
            </div>
        </div>

        {{-- Desktop table --}}
        <div class="mt-5 hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500">
                        <th class="py-2 pr-4">Product</th>
                        <th class="py-2 pr-4">Price</th>
                        <th class="py-2 pr-4">Qty</th>
                        <th class="py-2 pr-0 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/60">
                    @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="py-3 pr-4">
                                <div class="font-semibold text-gray-900">{{ $item->product_name }}</div>
                            </td>
                            <td class="py-3 pr-4 text-gray-700">{{ $item->price }}৳</td>
                            <td class="py-3 pr-4 text-gray-700">{{ $item->quantity }}</td>
                            <td class="py-3 pr-0 text-right font-extrabold text-gray-900">
                                {{ $item->total }}৳
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile cards --}}
        <div class="mt-5 md:hidden space-y-3">
            @foreach($order->items as $item)
                <div class="rounded-2xl border bg-white p-4">
                    <div class="font-semibold text-gray-900">{{ $item->product_name }}</div>
                    <div class="mt-2 flex items-center justify-between text-xs text-gray-600">
                        <span>{{ $item->price }}৳ × {{ $item->quantity }}</span>
                        <span class="font-extrabold text-gray-900">{{ $item->total }}৳</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Totals --}}
        <div class="mt-6 border-t pt-4 space-y-2 text-sm">
            <div class="flex justify-between text-gray-600">
                <span>Subtotal</span>
                <span class="font-semibold">{{ $order->subtotal }}৳</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Delivery Charge</span>
                <span class="font-semibold">{{ $order->delivery_charge }}৳</span>
            </div>
            <div class="flex justify-between font-extrabold text-lg text-gray-900">
                <span>Total</span>
                <span>{{ $order->total }}৳</span>
            </div>
        </div>
    </div>

    {{-- ================= UPDATE STATUS ================= --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-blue-600"></i>
                    Update Order Status
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Choose the current status so your workflow stays clean.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.orders.status', $order) }}"
                  class="flex items-center gap-3">
                @csrf

                <select name="status"
                        class="px-5 py-2 rounded-2xl text-sm border bg-white
                               focus:ring-2 focus:ring-emerald-400 outline-none">
                    @foreach(['pending','taken','processing','completed','delivered'] as $s)
                        <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-2xl text-white text-sm font-semibold shadow-md hover:shadow-lg transition"
                        style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                    <i class="fa-solid fa-check"></i>
                    Save
                </button>
            </form>
        </div>
    </div>

</div>

{{-- ================= SCRIPTS ================= --}}
<script>
    // Toast auto hide
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) toast.remove();
    }, 2600);

    function copyText(txt) {
        navigator.clipboard.writeText(txt || '').then(() => toast('Copied!'));
    }

    function toast(message) {
        const el = document.createElement('div');
        el.className = 'fixed top-6 right-6 z-[60] bg-gray-900 text-white px-4 py-3 rounded-2xl shadow-xl text-sm flex items-center gap-2';
        el.innerHTML = `<i class="fa-solid fa-circle-check text-emerald-400"></i><span>${message}</span>`;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 1400);
    }
</script>

<style>
@keyframes slideIn {
    from { transform: translateX(30px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}
.animate-slide-in {
    animation: slideIn .35s ease-out;
}

@media print {
    header, aside, #toast { display: none !important; }
    main { margin-top: 0 !important; padding: 0 !important; }
    body { background: #fff !important; }
}
</style>
@endsection
