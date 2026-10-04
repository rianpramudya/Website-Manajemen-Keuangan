@props(['title' => 'Belum ada data', 'text' => 'Mulai dengan menambahkan catatan pertama.', 'icon' => 'wallet'])
<div {{ $attributes->class(['empty']) }} data-reveal>
    <x-icon :name="$icon" /><h3>{{ $title }}</h3><p class="muted">{{ $text }}</p>{{ $slot }}
</div>
