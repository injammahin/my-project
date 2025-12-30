@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
$base = 'inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'default' => 'bg-black text-white hover:bg-black/90',
    'outline' => 'border border-gray-300 hover:bg-gray-100',
    'ghost' => 'hover:bg-gray-100',
];

$sizes = [
    'default' => 'h-10 px-4 py-2',
    'sm' => 'h-9 px-3',
    'lg' => 'h-11 px-8',
];
@endphp

<button {{ $attributes->merge([
    'class' => "$base {$variants[$variant]} {$sizes[$size]}"
]) }}>
    {{ $slot }}
</button>
