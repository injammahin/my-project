@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
@php
    // KPIs from current page collection (fast, no extra query)
    $col = $orders->getCollection();

    $kpiTotal      = $orders->total(); // total rows in paginator
    $kpiPending    = $col->where('status','pending')->count();
    $kpiProcessing = $col->where('status','processing')->count();
    $kpiDelivered  = $col->where('status','delivered')->count();

    function badgeClass($status) {
        $s = strtolower((string)$status);
        return match($s) {
            'pending'    => 'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200',
            'taken'      => 'bg-indigo-100 text-indigo-800 ring-1 ring-indigo-200',
            'processing' => 'bg-blue-100 text-blue-800 ring-1 ring-blue-200',
            'completed'  => 'bg-violet-100 text-violet-800 ring-1 ring-violet-200',
            'delivered'  => 'bg-emerald-100 text-emerald-800 ring-1 ring-emerald-200',
            default      => 'bg-gray-100 text-gray-800 ring-1 ring-gray-200',
        };
    }

    // Keep filters in pagination links
    $query = request()->query();
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

<div class="space-y-6">

    {{-- ================= HERO ================= --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-lg">
        <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full blur-3xl opacity-25"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>
        <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-20"
             style="background: radial-gradient(circle, #22c55e, transparent 70%);"></div>

        <div class="relative flex flex-col md:flex-row md:items-start md:justify-between gap-5">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/70 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Orders Center
                </div>

                <h2 class="mt-3 text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Orders
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Search, filter, update status and manage orders quickly.
                </p>
            </div>

            <div class="flex flex-wrap gap-2 md:justify-end">
                <a href="{{ route('admin.orders.export', request()->query()) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-white text-sm font-semibold shadow-md hover:shadow-lg transition"
                   style="background: linear-gradient(90deg, #16a34a, #22c55e);">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </a>

                <a href="{{ url()->current() }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                    <i class="fa-solid fa-rotate-left"></i>
                    Reset
                </a>
            </div>
        </div>

        {{-- KPI row --}}
        <div class="relative mt-5 grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-gray-500">Total Orders</div>
                <div class="mt-1 text-2xl font-extrabold text-gray-900">{{ $kpiTotal }}</div>
                <div class="mt-1 text-xs text-gray-500">All orders in database</div>
            </div>
            <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-gray-500">Pending (this page)</div>
                <div class="mt-1 text-2xl font-extrabold text-yellow-700">{{ $kpiPending }}</div>
                <div class="mt-1 text-xs text-gray-500">Needs action</div>
            </div>
            <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-gray-500">Processing (this page)</div>
                <div class="mt-1 text-2xl font-extrabold text-blue-700">{{ $kpiProcessing }}</div>
                <div class="mt-1 text-xs text-gray-500">In progress</div>
            </div>
            <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-gray-500">Delivered (this page)</div>
                <div class="mt-1 text-2xl font-extrabold text-emerald-700">{{ $kpiDelivered }}</div>
                <div class="mt-1 text-xs text-gray-500">Completed</div>
            </div>
        </div>
    </div>

    {{-- ================= FILTER BAR ================= --}}
    <form method="GET" class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-4 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">

            {{-- Search --}}
            <div class="md:col-span-5">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    <input
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search name / phone / order id..."
                        class="w-full outline-none text-sm text-gray-900 placeholder:text-gray-400 bg-transparent"
                    />
                </div>
            </div>

            {{-- Status --}}
            <div class="md:col-span-3">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-solid fa-filter text-gray-400"></i>
                    <select name="status" class="w-full bg-transparent outline-none text-sm">
                        <option value="" @selected(!request('status'))>All status</option>
                        @foreach(['pending','taken','processing','completed','delivered'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Date range --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-regular fa-calendar text-gray-400"></i>
                    <select name="range" class="w-full bg-transparent outline-none text-sm">
                        <option value="" @selected(!request('range'))>All time</option>
                        <option value="today" @selected(request('range')==='today')>Today</option>
                        <option value="7d" @selected(request('range')==='7d')>Last 7 days</option>
                        <option value="30d" @selected(request('range')==='30d')>Last 30 days</option>
                    </select>
                </div>
            </div>

            {{-- Per page --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-solid fa-list-ol text-gray-400"></i>
                    <select name="per_page" class="w-full bg-transparent outline-none text-sm" onchange="this.form.submit()">
                        @foreach([10,25,50,100] as $size)
                            <option value="{{ $size }}" @selected((int)request('per_page',10) === $size)>
                                {{ $size }} / page
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Button row --}}
            <div class="md:col-span-12 flex flex-wrap items-center justify-between gap-3 mt-1">
                <div class="text-xs text-gray-500 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i>
                    Tip: Change status from the dropdown to update instantly.
                </div>

                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-white text-sm font-semibold shadow-md hover:shadow-lg transition"
                        style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                    <i class="fa-solid fa-bolt"></i>
                    Apply Filters
                </button>
            </div>
        </div>
    </form>

    {{-- ================= TABLE WRAPPER ================= --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-white/60 flex items-center justify-between">
            <div class="font-extrabold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-table-list text-emerald-600"></i>
                Orders List
            </div>
            <div class="text-xs text-gray-500">
                Showing {{ $orders->count() }} on this page
            </div>
        </div>

        <!-- DESKTOP TABLE -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr class="text-left">
                        <th class="px-6 py-4 font-semibold">Order</th>
                        <th class="px-6 py-4 font-semibold">Customer</th>
                        <th class="px-6 py-4 font-semibold">Products</th>
                        <th class="px-6 py-4 font-semibold">Total</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/60">
                    @forelse($orders as $order)
                        @php
                            $itemsCountRow = $order->items?->sum('quantity') ?? 0;
                        @endphp

                        <tr class="hover:bg-gray-50/70 transition align-top">
                            {{-- Order --}}
                            <td class="px-6 py-4">
                                <div class="font-extrabold text-gray-900">#{{ $order->id }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ optional($order->created_at)->timezone('Asia/Dhaka')->format('d M, h:i A') ?? '—' }}
                                </div>
                                <div class="mt-2 inline-flex items-center gap-2 text-xs text-gray-600">
                                    <i class="fa-solid fa-cubes"></i>
                                    Items: <span class="font-semibold">{{ $itemsCountRow }}</span>
                                </div>
                            </td>

                            {{-- Customer --}}
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">
                                    {{ $order->customer_name }}
                                </div>
                                <div class="text-xs text-gray-600 mt-1 flex items-center gap-2">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>{{ $order->customer_phone }}</span>
                                </div>
                            </td>

                            {{-- Products --}}
                            <td class="px-6 py-4">
                                <ul class="space-y-1">
                                    @foreach($order->items as $item)
                                        <li class="text-xs flex justify-between gap-3">
                                            <span class="truncate max-w-[260px]">{{ $item->product_name }}</span>
                                            <span class="font-semibold">× {{ $item->quantity }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-4">
                                <div class="text-lg font-extrabold text-gray-900">
                                    {{ $order->total }}৳
                                </div>
                                <div class="text-xs text-gray-500">
                                    Subtotal: {{ $order->subtotal ?? '—' }}৳
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()"
                                            class="status-select {{ $order->status }}">
                                        @foreach(['pending','taken','processing','completed','delivered'] as $s)
                                            <option value="{{ $s }}" @selected($order->status === $s)>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                                <div class="mt-2">
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ badgeClass($order->status) }}">
                                        <i class="fa-solid fa-circle"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </td>

                            {{-- Action --}}
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2 justify-end">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="px-4 py-2 rounded-2xl text-white text-xs font-semibold shadow-md hover:shadow-lg transition"
                                       style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                                        <i class="fa-solid fa-eye"></i>
                                        View
                                    </a>

                                    <button type="button"
                                            onclick="openDeleteModal({{ $order->id }})"
                                            class="px-4 py-2 rounded-2xl border bg-white hover:bg-gray-50 text-xs font-semibold text-red-600">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- MOBILE CARD VIEW -->
        <div class="md:hidden divide-y">
            @forelse($orders as $order)
                @php $itemsCountRow = $order->items?->sum('quantity') ?? 0; @endphp

                <div class="p-5 space-y-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-lg font-extrabold text-gray-900">#{{ $order->id }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ optional($order->created_at)->timezone('Asia/Dhaka')->format('d M, h:i A') ?? '—' }}
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ badgeClass($order->status) }}">
                            <i class="fa-solid fa-circle"></i>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="rounded-2xl border bg-white p-4">
                        <div class="font-semibold text-gray-900">{{ $order->customer_name }}</div>
                        <div class="text-xs text-gray-600 mt-1 flex items-center gap-2">
                            <i class="fa-solid fa-phone"></i>
                            <span>{{ $order->customer_phone }}</span>
                        </div>
                        <div class="text-xs text-gray-600 mt-2 flex items-center gap-2">
                            <i class="fa-solid fa-cubes"></i>
                            Items: <span class="font-semibold">{{ $itemsCountRow }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-gray-600 text-sm">Total</div>
                        <div class="text-xl font-extrabold text-gray-900">{{ $order->total }}৳</div>
                    </div>

                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                        @csrf
                        <select name="status" onchange="this.form.submit()"
                                class="status-select {{ $order->status }} w-full">
                            @foreach(['pending','taken','processing','completed','delivered'] as $s)
                                <option value="{{ $s }}" @selected($order->status === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="flex-1 text-center px-4 py-2 rounded-2xl text-white text-sm font-semibold"
                           style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <button type="button"
                                onclick="openDeleteModal({{ $order->id }})"
                                class="flex-1 px-4 py-2 rounded-2xl border bg-white text-sm font-semibold text-red-600">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-gray-500">No orders found.</div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <p class="text-sm text-gray-600">
                    Showing
                    <span class="font-semibold">{{ $orders->firstItem() }}</span>
                    to
                    <span class="font-semibold">{{ $orders->lastItem() }}</span>
                    of
                    <span class="font-semibold">{{ $orders->total() }}</span>
                    orders
                </p>

                <div>
                    {{ $orders->appends(request()->query())->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- DELETE CONFIRMATION MODAL --}}
<div id="deleteModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-6">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-red-50 text-red-600 grid place-items-center">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-extrabold text-gray-900">Delete Order?</h3>
                <p class="text-sm text-gray-600 mt-1">
                    This action cannot be undone. All order items will be permanently removed.
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 rounded-2xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                Cancel
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 rounded-2xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    // Toast auto hide
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) toast.remove();
    }, 2600);

    function openDeleteModal(orderId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = `/admin/orders/${orderId}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<style>
    /* STATUS COLORS */
    .status-select {
        width: 100%;
        font-size: 12px;
        padding: 10px 14px;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        font-weight: 700;
        cursor: pointer;
        background: #fff;
        outline: none;
    }
    @media (min-width: 768px) {
        .status-select { width: auto; }
    }

    .status-select.pending { background: #fef9c3; color: #92400e; }
    .status-select.taken { background: #e0e7ff; color: #3730a3; }
    .status-select.processing { background: #dbeafe; color: #1e40af; }
    .status-select.completed { background: #ede9fe; color: #5b21b6; }
    .status-select.delivered { background: #dcfce7; color: #166534; }

    /* TOAST ANIMATION */
    @keyframes slideIn {
        from { transform: translateX(30px); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in { animation: slideIn .35s ease-out; }
</style>
@endsection
