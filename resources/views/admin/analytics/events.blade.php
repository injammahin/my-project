@extends('layouts.admin')

@section('title', 'Analytics Events')

@section('content')

<div class="bg-background border rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-muted">
            <tr>
                <th class="px-4 py-3 text-left">Time</th>
                <th class="px-4 py-3">Visitor</th>
                <th class="px-4 py-3">Event</th>
                <th class="px-4 py-3">Page</th>
                <th class="px-4 py-3">Data</th>
            </tr>
        </thead>

        <tbody class="divide-y">
        @foreach($events as $e)
            <tr class="align-top">
                <td class="px-4 py-3">
                    {{ $e->created_at->format('H:i:s') }}
                </td>

                <td class="px-4 py-3">
                    <a href="/admin/analytics/session/{{ $e->visitor->visitor_id }}"
                       class="text-primary underline">
                        {{ \Illuminate\Support\Str::limit($e->visitor->visitor_id, 10) }}
                    </a>
                </td>

                <td class="px-4 py-3 font-semibold">
                    {{ $e->event }}
                </td>

                <td class="px-4 py-3 text-xs text-muted-foreground">
                    {{ $e->page }}
                </td>

                <td class="px-4 py-3">
                    <pre class="text-xs bg-muted p-2 rounded-lg overflow-x-auto">
{{ json_encode($e->data, JSON_PRETTY_PRINT) }}
                    </pre>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<div class="mt-6">
    {{ $events->links() }}
</div>

@endsection
