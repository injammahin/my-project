@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')

{{-- SUCCESS TOAST --}}
@if(session('success'))
<div id="toast"
     class="fixed top-6 right-6 z-50
            bg-[#1f2d1f] text-white
            px-6 py-3 rounded-2xl shadow-xl
            text-sm animate-slide-in">
    ✅ {{ session('success') }}
</div>
@endif

<div class="max-w-4xl mx-auto space-y-8">

    {{-- ORDER HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-[#1f2d1f]">
            Order #{{ $order->id }}
        </h2>

        <span class="px-4 py-1.5 rounded-full text-xs font-semibold
            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
            @elseif($order->status === 'delivered') bg-green-100 text-green-800
            @else bg-gray-100 text-gray-800
            @endif">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    {{-- CUSTOMER INFO --}}
    <div class="bg-white/80 backdrop-blur-xl
                border border-white/60
                rounded-3xl shadow-lg p-6">

        <h3 class="text-lg font-semibold text-[#1f2d1f] mb-4">
            Customer Information
        </h3>

        <div class="grid sm:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-gray-500">Name</p>
                <p class="font-medium text-[#1f2d1f]">
                    {{ $order->customer_name }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Phone</p>
                <p class="font-medium text-[#1f2d1f]">
                    {{ $order->customer_phone }}
                </p>
            </div>

            <div class="sm:col-span-2">
                <p class="text-gray-500">Address</p>
                <p class="font-medium text-[#1f2d1f]">
                    {{ $order->customer_address }}
                </p>
            </div>
        </div>
    </div>

    {{-- ORDER ITEMS --}}
    <div class="bg-white/80 backdrop-blur-xl
                border border-white/60
                rounded-3xl shadow-lg p-6">

        <h3 class="text-lg font-semibold text-[#1f2d1f] mb-4">
            Ordered Products
        </h3>

        <div class="space-y-3">
            @foreach($order->items as $item)
                <div class="flex justify-between items-center
                            bg-[#f3f7e8] rounded-xl px-4 py-3">

                    <div>
                        <p class="font-medium text-[#1f2d1f]">
                            {{ $item->product_name }}
                        </p>
                        <p class="text-xs text-gray-600">
                            {{ $item->price }}৳ × {{ $item->quantity }}
                        </p>
                    </div>

                    <div class="font-bold text-[#1f2d1f]">
                        {{ $item->total }}৳
                    </div>
                </div>
            @endforeach
        </div>

        {{-- TOTALS --}}
        <div class="border-t mt-6 pt-4 space-y-2 text-sm">
            <div class="flex justify-between text-gray-600">
                <span>Subtotal</span>
                <span>{{ $order->subtotal }}৳</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Delivery Charge</span>
                <span>{{ $order->delivery_charge }}৳</span>
            </div>
            <div class="flex justify-between font-bold text-lg text-[#1f2d1f]">
                <span>Total</span>
                <span>{{ $order->total }}৳</span>
            </div>
        </div>
    </div>

    {{-- UPDATE STATUS --}}
    <div class="bg-white/80 backdrop-blur-xl
                border border-white/60
                rounded-3xl shadow-lg p-6">

        <h3 class="text-lg font-semibold text-[#1f2d1f] mb-4">
            Update Order Status
        </h3>

        <form method="POST"
              action="{{ route('admin.orders.status', $order) }}"
              class="flex items-center gap-4">
            @csrf

            <select name="status"
                    class="px-5 py-2 rounded-full text-sm
                           border border-[#c7d7b5]
                           focus:ring-2 focus:ring-[#7db343]">
                @foreach(['pending','taken','processing','completed','delivered'] as $status)
                    <option value="{{ $status }}"
                        @selected($order->status === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                    class="bg-[#1f2d1f] hover:bg-[#162016]
                           text-white px-6 py-2 rounded-full
                           text-sm font-medium transition">
                Update Status
            </button>
        </form>
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
@keyframes slideIn {
    from { transform: translateX(30px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}
.animate-slide-in {
    animation: slideIn .35s ease-out;
}
</style>

@endsection
