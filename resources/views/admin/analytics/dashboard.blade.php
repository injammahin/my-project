@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-background border rounded-xl p-6 text-center">
        👥 Visitors
        <div class="text-2xl font-bold mt-2">{{ $totalVisitors }}</div>
    </div>

    <div class="bg-background border rounded-xl p-6 text-center">
        📅 Today
        <div class="text-2xl font-bold mt-2">{{ $todayVisitors }}</div>
    </div>

    <div class="bg-background border rounded-xl p-6 text-center">
        ⚡ Events Today
        <div class="text-2xl font-bold mt-2">{{ $eventsToday }}</div>
    </div>

    <div class="bg-background border rounded-xl p-6 text-center">
        🟢 Live Now
        <div class="text-2xl font-bold mt-2">{{ $activeVisitors }}</div>
    </div>

</div>

@endsection
