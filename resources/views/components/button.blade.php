@props(['variant' => 'primary', 'href' => null, 'type' => 'button', 'icon' => null])
@php($variants = ['primary' => 'btn-primary', 'secondary' => 'btn-secondary', 'tertiary' => 'btn-tertiary', 'danger' => 'btn-danger'])
@if($href)
<a href="{{ $href }}" {{ $attributes->class(['btn', $variants[$variant] ?? $variants['primary']]) }}>
    @if($icon)<x-icon :name="$icon" />@endif {{ $slot }}
</a>
@else
<button type="{{ $type }}" {{ $attributes->class(['btn', $variants[$variant] ?? $variants['primary']]) }}>
    @if($icon)<x-icon :name="$icon" />@endif <span data-button-label>{{ $slot }}</span>
</button>
@endif
