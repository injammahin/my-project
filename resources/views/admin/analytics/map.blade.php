@extends('layouts.admin')

@section('title', 'Visitor Map')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')

    <div class="space-y-6">

        {{-- HEADER CARD --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot text-green-600"></i>
                        Visitor Map (Bangladesh)
                    </h2>

                    <p class="text-sm text-gray-600 mt-1">
                        Visitor city is detected from IP address (approx). Best works on live hosting (not localhost).
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 rounded-2xl bg-white border text-sm">
                        Total points: <span class="font-bold">{{ $points->count() }}</span>
                    </div>

                    <a href="{{ url('/admin/analytics/events') }}"
                        class="px-4 py-2 rounded-2xl bg-gray-900 text-white text-sm font-semibold hover:opacity-90">
                        View Events →
                    </a>
                </div>
            </div>
        </div>

        {{-- TOP CITIES --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-city text-indigo-600"></i>
                Top Cities
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                @forelse($cityStats as $row)
                    <div class="rounded-2xl border bg-white p-4">
                        <div class="text-sm font-semibold text-gray-900 truncate">
                            {{ $row->city ?? 'Unknown' }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Visitors</div>
                        <div class="text-xl font-extrabold mt-1">{{ $row->total }}</div>
                    </div>
                @empty
                    <div class="text-sm text-gray-500">No city data yet.</div>
                @endforelse
            </div>
        </div>

        {{-- MAP --}}
        <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-rose-600"></i>
                    Visitor Locations
                </h3>
                <div class="text-xs text-gray-500">
                    Tip: Click a marker to see details
                </div>
            </div>

            <div id="map" class="mt-4 rounded-2xl border" style="height: 560px;"></div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const points = @json($points);

        // Bangladesh center
        const map = L.map('map').setView([23.6850, 90.3563], 7);

        // OSM tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        let plotted = 0;

        points.forEach(p => {
            if (!p.lat || !p.lng) return;
            plotted++;

            const popup = `
                    <div style="font-size:13px; line-height:1.4">
                        <div style="font-weight:700; margin-bottom:6px">Visitor</div>
                        <div><b>ID:</b> ${p.visitor_id}</div>
                        <div><b>City:</b> ${p.city ?? '—'}</div>
                        <div><b>Region:</b> ${p.region ?? '—'}</div>
                        <div><b>Country:</b> ${p.country ?? '—'}</div>
                        <hr style="margin:8px 0;">
                        <div><b>Device:</b> ${p.device ?? '—'}</div>
                        <div style="color:#666"><b>IP:</b> ${p.ip ?? '—'}</div>
                    </div>
                `;

            L.circleMarker([parseFloat(p.lat), parseFloat(p.lng)], {
                radius: 6,
                weight: 2,
                fillOpacity: 0.35
            }).addTo(map).bindPopup(popup);
        });

        if (plotted === 0) {
            console.warn("No points found. On localhost, IP geo doesn't work.");
        }
    </script>
@endpush