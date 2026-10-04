@props(['title' => 'Belum ada data', 'text' => 'Mulai dengan menambahkan catatan pertama.', 'icon' => 'wallet'])
<div {{ $attributes->class(['empty']) }} data-reveal>
    <x-illustration :kind="$icon === 'check-circle' ? 'full' : ($icon === 'chart-bar' ? 'coins' : 'empty')" /><h3>{{ $title }}</h3><p class="muted">{{ $text }}</p>{{ $slot }}
</div>
