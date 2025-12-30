@extends('layouts.admin')

@section('title', 'Visitor Session')

@section('content')

<h2 class="text-xl font-bold mb-6">
    Visitor: {{ $visitor->visitor_id }}
</h2>

<div class="space-y-4">

@foreach($events as $e)
    <div class="border-l-4 border-green-600 bg-muted/40
                pl-4 py-3 rounded-lg">

        <p class="text-xs text-gray-500 mb-1">
            {{ $e->created_at->format('Y-m-d H:i:s') }}
        </p>

        <p class="font-semibold text-green-800">
            {{ $e->event }}
        </p>

        @if($e->page)
            <p class="text-xs text-gray-600">
                Page: {{ $e->page }}
            </p>
        @endif

        @if($e->data)
            <pre class="mt-2 text-xs bg-background p-2 rounded">
{{ json_encode($e->data, JSON_PRETTY_PRINT) }}
            </pre>
        @endif

    </div>
@endforeach

</div>

@endsection
