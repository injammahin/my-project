@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- PAGE HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-[#1f2d1f]">
            Admin Dashboard
        </h2>
        <p class="text-sm text-muted-foreground mt-1">
            Overview of today’s store performance
        </p>
    </div>

    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- TOTAL ORDERS --}}
        <div class="bg-white/80 backdrop-blur-xl
                    border border-white/60
                    rounded-3xl shadow-lg p-6
                    hover:shadow-xl transition">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-3xl font-bold text-[#1f2d1f] mt-2">
                        {{ \App\Models\Order::count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-full bg-[#e6efd3]
                            flex items-center justify-center text-xl">
                    📦
                </div>
            </div>
        </div>

        {{-- PENDING --}}
        <div class="bg-white/80 backdrop-blur-xl
                    border border-white/60
                    rounded-3xl shadow-lg p-6
                    hover:shadow-xl transition">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-3xl font-bold text-yellow-700 mt-2">
                        {{ \App\Models\Order::where('status','pending')->count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-full bg-yellow-100
                            flex items-center justify-center text-xl">
                    ⏳
                </div>
            </div>
        </div>

        {{-- PROCESSING --}}
        <div class="bg-white/80 backdrop-blur-xl
                    border border-white/60
                    rounded-3xl shadow-lg p-6
                    hover:shadow-xl transition">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Processing</p>
                    <p class="text-3xl font-bold text-blue-700 mt-2">
                        {{ \App\Models\Order::where('status','processing')->count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-full bg-blue-100
                            flex items-center justify-center text-xl">
                    ⚙️
                </div>
            </div>
        </div>

        {{-- DELIVERED --}}
        <div class="bg-white/80 backdrop-blur-xl
                    border border-white/60
                    rounded-3xl shadow-lg p-6
                    hover:shadow-xl transition">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Delivered</p>
                    <p class="text-3xl font-bold text-green-700 mt-2">
                        {{ \App\Models\Order::where('status','delivered')->count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-full bg-green-100
                            flex items-center justify-center text-xl">
                    ✅
                </div>
            </div>
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="bg-white/80 backdrop-blur-xl
                border border-white/60
                rounded-3xl shadow-lg p-6">

        <h3 class="text-lg font-semibold text-[#1f2d1f] mb-4">
            Quick Actions
        </h3>

        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.orders.index') }}"
               class="inline-flex items-center gap-2
                      bg-[#1f2d1f] hover:bg-[#162016]
                      text-white px-6 py-3 rounded-full
                      text-sm font-medium transition">
                📦 View Orders
            </a>

            <a href="{{ route('admin.orders.index') }}?status=pending"
               class="inline-flex items-center gap-2
                      bg-yellow-600 hover:bg-yellow-700
                      text-white px-6 py-3 rounded-full
                      text-sm font-medium transition">
                ⏳ Pending Orders
            </a>
        </div>
    </div>

</div>

@endsection
