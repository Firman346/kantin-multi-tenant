@props(['status'])

@php
    $classes = match ($status) {
        'aktif', 'selesai' => 'bg-green-100 text-green-800',
        'diproses' => 'bg-yellow-100 text-yellow-800',
        'dibatalkan' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium $classes"
]) }}>
    {{ ucfirst($status) }}
</span>