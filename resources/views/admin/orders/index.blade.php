@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

{{-- ✅ SUCCESS TOAST --}}
@if(session('success'))
<div id="toast"
     class="fixed top-6 right-6 z-50
            bg-[#1f2d1f] text-white
            px-6 py-3 rounded-2xl shadow-xl
            text-sm flex items-center gap-2
            animate-slide-in">
    ✅ {{ session('success') }}
</div>
@endif

<div class="bg-white/80 backdrop-blur-xl
            border border-white/60
            rounded-3xl shadow-lg overflow-hidden">

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block">
        <table class="w-full text-sm">
            <thead class="bg-[#e6efd3] text-[#1f2d1f]">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Order</th>
                    <th class="px-6 py-4 font-semibold">Customer</th>
                    <th class="px-6 py-4 font-semibold">Products</th>
                    <th class="px-6 py-4 font-semibold">Total</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 text-right font-semibold">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#e6efd3]">
            @foreach($orders as $order)
                <tr class="hover:bg-[#f3f7e8] transition align-top">

                    <td class="px-6 py-4 font-bold text-[#1f2d1f]">
                        #{{ $order->id }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium text-[#1f2d1f]">
                            {{ $order->customer_name }}
                        </div>
                        <div class="text-xs text-gray-600 mt-1">
                            {{ $order->customer_phone }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <ul class="space-y-1">
                            @foreach($order->items as $item)
                                <li class="text-xs flex justify-between gap-3">
                                    <span>{{ $item->product_name }}</span>
                                    <span class="font-semibold">× {{ $item->quantity }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <td class="px-6 py-4 font-extrabold">
                        {{ $order->total }}৳
                    </td>

                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                            @csrf
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="status-select {{ $order->status }}">
                                @foreach(['pending','taken','processing','completed','delivered'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-[#3b7a57] font-semibold hover:underline">
                            View →
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD VIEW -->
    <div class="md:hidden divide-y">
        @foreach($orders as $order)
        <div class="p-5 space-y-3">

            <div class="flex justify-between items-center">
                <span class="font-bold text-[#1f2d1f]">#{{ $order->id }}</span>
                <span class="font-bold">{{ $order->total }}৳</span>
            </div>

            <div>
                <p class="font-medium">{{ $order->customer_name }}</p>
                <p class="text-xs text-gray-600">{{ $order->customer_phone }}</p>
            </div>

            <ul class="text-xs space-y-1">
                @foreach($order->items as $item)
                    <li>• {{ $item->product_name }} × {{ $item->quantity }}</li>
                @endforeach
            </ul>

            <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                @csrf
                <select name="status"
                        onchange="this.form.submit()"
                        class="status-select {{ $order->status }} w-full">
                    @foreach(['pending','taken','processing','completed','delivered'] as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('admin.orders.show', $order) }}"
               class="inline-block text-sm text-[#3b7a57] font-semibold">
                View Details →
            </a>
        </div>
        @endforeach
    </div>

</div>

{{-- TOAST AUTO HIDE --}}
<script>
setTimeout(() => {
    const toast = document.getElementById('toast');
    if (toast) toast.remove();
}, 3000);
</script>

<style>
/* STATUS COLORS */
.status-select {
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 9999px;
    border: 1px solid transparent;
    font-weight: 600;
    cursor: pointer;
}
.status-select.pending {
    background: #fef9c3;
    color: #92400e;
}
.status-select.taken {
    background: #e0e7ff;
    color: #3730a3;
}
.status-select.processing {
    background: #dbeafe;
    color: #1e40af;
}
.status-select.completed {
    background: #ede9fe;
    color: #5b21b6;
}
.status-select.delivered {
    background: #dcfce7;
    color: #166534;
}

/* TOAST ANIMATION */
@keyframes slideIn {
    from { transform: translateX(30px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}
.animate-slide-in {
    animation: slideIn .35s ease-out;
}
</style>

@endsection
