@props(['id', 'title'])
<dialog id="{{ $id }}" aria-labelledby="{{ $id }}-title" {{ $attributes->class(['dialog']) }}>
    <div class="dialog-title"><h2 id="{{ $id }}-title">{{ $title }}</h2><x-button variant="tertiary" data-close-dialog aria-label="Tutup dialog" icon="x" /></div>
    {{ $slot }}
</dialog>
