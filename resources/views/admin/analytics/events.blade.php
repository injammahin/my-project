@extends('layouts.admin')

@section('title', 'Visitor Activity')

@section('content')
@php
    $eventMap = [
        'page_view'       => ['label'=>'Page View',      'icon'=>'fa-regular fa-file-lines',   'chip'=>'bg-blue-50 text-blue-700 ring-1 ring-blue-100'],
        'scroll_depth'    => ['label'=>'Scroll Depth',   'icon'=>'fa-solid fa-arrow-down',     'chip'=>'bg-indigo-50 text-indigo-700 ring-1 ring-indigo-100'],
        'add_to_cart'     => ['label'=>'Add to Cart',    'icon'=>'fa-solid fa-cart-shopping',  'chip'=>'bg-amber-50 text-amber-800 ring-1 ring-amber-100'],
        'checkout_start'  => ['label'=>'Checkout Start', 'icon'=>'fa-regular fa-credit-card',  'chip'=>'bg-violet-50 text-violet-700 ring-1 ring-violet-100'],
        'purchase'        => ['label'=>'Purchase',       'icon'=>'fa-solid fa-sack-dollar',    'chip'=>'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100'],
        'exit_intent'     => ['label'=>'Exit Intent',    'icon'=>'fa-regular fa-circle-xmark', 'chip'=>'bg-rose-50 text-rose-700 ring-1 ring-rose-100'],
        'form_start'      => ['label'=>'Form Start',     'icon'=>'fa-regular fa-pen-to-square','chip'=>'bg-sky-50 text-sky-700 ring-1 ring-sky-100'],
        'time_on_page'    => ['label'=>'Time on Page',   'icon'=>'fa-regular fa-clock',        'chip'=>'bg-gray-50 text-gray-700 ring-1 ring-gray-100'],
    ];

    $collection = $events->getCollection();
    $shown = $collection->count();
    $uniqueVisitors = $collection->map(fn($e) => optional($e->visitor)->visitor_id)->filter()->unique()->count();
    $withDetails = $collection->filter(fn($e) => !empty($e->data))->count();
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-6 shadow-xl">
        <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full blur-3xl opacity-30"
             style="background: radial-gradient(circle, var(--button, #1f2d1f), transparent 70%);"></div>

        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/70 border border-white/60 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    Live Visitor Feed
                </div>

                <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Visitor Activity
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Latest action per visitor. Click a visitor to view full session timeline.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <div class="inline-flex items-center gap-2 rounded-2xl bg-white/70 border border-white/60 px-4 py-2 text-sm text-gray-700 shadow-sm">
                    <i class="fa-solid fa-users text-emerald-600"></i>
                    <span class="font-semibold">{{ $uniqueVisitors }}</span> visitors
                </div>
                <div class="inline-flex items-center gap-2 rounded-2xl bg-white/70 border border-white/60 px-4 py-2 text-sm text-gray-700 shadow-sm">
                    <i class="fa-solid fa-layer-group text-indigo-600"></i>
                    <span class="font-semibold">{{ $shown }}</span> rows
                </div>
                <div class="inline-flex items-center gap-2 rounded-2xl bg-white/70 border border-white/60 px-4 py-2 text-sm text-gray-700 shadow-sm">
                    <i class="fa-solid fa-circle-info text-amber-600"></i>
                    <span class="font-semibold">{{ $withDetails }}</span> with details
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl p-4 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">

            <div class="md:col-span-6">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    <input name="q" value="{{ request('q') }}"
                        placeholder="Search visitor id / ip / device / event / page..."
                        class="w-full outline-none text-sm text-gray-900 placeholder:text-gray-400 bg-transparent" />
                </div>
            </div>

            <div class="md:col-span-3">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-solid fa-filter text-gray-400"></i>
                    <select name="event" class="w-full bg-transparent outline-none text-sm">
                        <option value="all" @selected(request('event','all')==='all')>All events</option>
                        @foreach(array_keys($eventMap) as $key)
                            <option value="{{ $key }}" @selected(request('event')===$key)>{{ $eventMap[$key]['label'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                    <i class="fa-regular fa-calendar text-gray-400"></i>
                    <select name="range" class="w-full bg-transparent outline-none text-sm">
                        <option value="all"  @selected(request('range','all')==='all')>All time</option>
                        <option value="today" @selected(request('range')==='today')>Today</option>
                        <option value="7d"   @selected(request('range')==='7d')>Last 7 days</option>
                        <option value="30d"  @selected(request('range')==='30d')>Last 30 days</option>
                    </select>
                </div>
            </div>

            <div class="md:col-span-1 flex md:justify-end">
                <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-3 rounded-2xl text-white font-semibold shadow-md hover:shadow-lg transition"
                        style="background: linear-gradient(90deg, var(--button, #1f2d1f), #111827);">
                    <i class="fa-solid fa-bolt"></i> Go
                </button>
            </div>

        </div>
    </form>

    {{-- TABLE --}}
    <div class="rounded-3xl border border-white/60 bg-white/80 backdrop-blur-xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600">
                        <th class="px-6 py-4">Time</th>
                        <th class="px-6 py-4">Visitor</th>
                        <th class="px-6 py-4">Event</th>
                        <th class="px-6 py-4">Page</th>
                        <th class="px-6 py-4">Order Info</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/60">
                    @forelse($events as $e)
                        @php
                            $v = $e->visitor;
                            $meta = $eventMap[$e->event] ?? ['label'=>ucfirst((string)$e->event), 'icon'=>'fa-regular fa-circle', 'chip'=>'bg-gray-50 text-gray-700 ring-1 ring-gray-100'];
                            $public = $v->visitor_id ?? '—';
                            $last = isset($lastOrders) ? ($lastOrders[$public] ?? null) : null;

                            $phone = $last->customer_phone ?? $last->phone ?? null;
                            $name  = $last->customer_name ?? $last->name ?? null;
                        @endphp

                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                <div class="font-semibold text-gray-800">{{ $e->created_at?->format('d M') }}</div>
                                <div>{{ $e->created_at?->format('h:i A') }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ url('/admin/analytics/session/'.$public) }}"
                                   class="inline-flex items-center gap-2 font-semibold text-blue-700 hover:underline">
                                    <span class="w-8 h-8 rounded-2xl bg-blue-600/10 text-blue-700 grid place-items-center">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    {{ \Illuminate\Support\Str::limit($public, 18) }}
                                </a>

                                <div class="mt-1 text-xs text-gray-500">
                                    <span class="mr-2"><i class="fa-solid fa-wifi"></i> {{ $v->ip ?? '—' }}</span>
                                    <span><i class="fa-solid fa-laptop"></i> {{ $v->device ?? '—' }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $meta['chip'] }}">
                                    <i class="{{ $meta['icon'] }}"></i>
                                    {{ $meta['label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 max-w-[360px]">
                                <div class="text-gray-800 font-medium truncate">
                                    {{ $e->page ?? '/' }}
                                </div>
                                <div class="text-xs text-gray-500 truncate">
                                    {{ is_array($e->data) && isset($e->data['referrer']) ? ('Ref: '.\Illuminate\Support\Str::limit($e->data['referrer'], 40)) : '' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-xs text-gray-600">
                                @if($last)
                                    <div class="font-semibold text-gray-900">{{ $name ?? 'Customer' }}</div>
                                    <div class="text-gray-500">{{ $phone ?? '—' }}</div>
                                @else
                                    <span class="text-gray-400">No order linked</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2 justify-end">
                                    <button type="button"
                                        class="px-3 py-2 rounded-2xl border bg-white hover:bg-gray-50 text-xs font-semibold"
                                        data-copy="{{ $public }}">
                                        <i class="fa-regular fa-copy"></i> Copy ID
                                    </button>

                                    @if(!empty($e->data))
                                        <button type="button"
                                            class="px-3 py-2 rounded-2xl text-white text-xs font-semibold shadow-sm hover:shadow-md transition"
                                            style="background: linear-gradient(90deg, #0ea5e9, #2563eb);"
                                            data-open-details
                                            data-label="{{ $meta['label'] }}"
                                            data-visitor="{{ $public }}"
                                            data-details='@json($e->data)'>
                                            <i class="fa-solid fa-code"></i> Details
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-400 px-3 py-2">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500">
                                No activity found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t bg-white">
            {{ $events->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

{{-- DETAILS MODAL --}}
<div id="detailsModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" data-close-details></div>

    <div class="absolute inset-x-0 top-12 mx-auto w-[92%] max-w-2xl">
        <div class="rounded-3xl bg-white shadow-2xl overflow-hidden border">
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <div>
                    <div class="text-xs text-gray-500">Event details</div>
                    <div class="text-lg font-extrabold text-gray-900" id="detailsTitle">Details</div>
                    <div class="text-xs text-gray-500 mt-1" id="detailsSub">—</div>
                </div>

                <button class="w-10 h-10 rounded-2xl bg-gray-100 hover:bg-gray-200 transition grid place-items-center"
                        data-close-details>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6">
                <pre id="detailsJson" class="text-xs leading-relaxed bg-gray-50 border rounded-2xl p-4 overflow-auto max-h-[55vh]"></pre>

                <div class="mt-4 flex items-center justify-end gap-2">
                    <button class="px-4 py-2 rounded-2xl border text-sm font-semibold" id="copyDetailsBtn">
                        <i class="fa-regular fa-copy"></i> Copy JSON
                    </button>
                    <button class="px-4 py-2 rounded-2xl text-white text-sm font-semibold"
                            style="background: var(--button, #1f2d1f);"
                            data-close-details>
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toast(message) {
        const el = document.createElement('div');
        el.className = 'fixed top-6 right-6 z-[60] bg-gray-900 text-white px-4 py-3 rounded-2xl shadow-xl text-sm flex items-center gap-2';
        el.innerHTML = `<i class="fa-solid fa-circle-check text-emerald-400"></i><span>${message}</span>`;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 1600);
    }

    function copyText(txt) {
        txt = txt || '';
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(txt).then(() => toast('Copied!'));
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
        toast('Copied!');
    }

    function openDetails(raw, label, visitorId) {
        const modal = document.getElementById('detailsModal');
        document.getElementById('detailsTitle').textContent = label || 'Details';
        document.getElementById('detailsSub').textContent = `Visitor: ${visitorId || '—'}`;

        let data = raw;
        try {
            if (typeof raw === 'string') data = JSON.parse(raw);
        } catch (e) {}

        document.getElementById('detailsJson').textContent = JSON.stringify(data ?? {}, null, 2);
        modal.classList.remove('hidden');
    }

    function closeDetails() {
        document.getElementById('detailsModal').classList.add('hidden');
    }

    document.addEventListener('click', (ev) => {
        const openBtn = ev.target.closest('[data-open-details]');
        if (openBtn) {
            openDetails(
                openBtn.getAttribute('data-details'),
                openBtn.getAttribute('data-label'),
                openBtn.getAttribute('data-visitor')
            );
            return;
        }

        const copyBtn = ev.target.closest('[data-copy]');
        if (copyBtn) {
            copyText(copyBtn.getAttribute('data-copy'));
            return;
        }

        if (ev.target.closest('[data-close-details]')) {
            closeDetails();
            return;
        }
    });

    document.getElementById('copyDetailsBtn').addEventListener('click', () => {
        copyText(document.getElementById('detailsJson').textContent || '');
    });
</script>
@endsection
