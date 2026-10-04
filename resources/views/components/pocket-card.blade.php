@props(['category', 'value' => null])
@php($palette = ['yellow', 'teal', 'violet', 'orange', 'sky', 'lime', 'indigo', 'stone'][(int) $category->id % 8])
<a href="{{ route('categories.show', $category) }}" {{ $attributes->class(['pocket stack']) }} data-palette="{{ $palette }}" data-pocket-id="{{ $category->id }}" data-reveal>
    <span class="pocket-tab" aria-hidden="true"></span>
    <span class="pocket-icon"><x-icon :name="$category->type === 'income' ? 'wallet' : 'bag'" /></span>
    <h3 class="break-words">{{ $category->name }}</h3>
    <p class="muted">{{ $category->type === 'income' ? 'Kantong tabungan' : 'Kantong pengeluaran' }}</p>
    <x-money :value="$value ?? $category->balance" class="block text-2xl font-extrabold" :count="true" />
</a>
