@props(['name', 'show' => false, 'maxWidth' => '2xl'])
<x-dialog :id="$name" title="Konfirmasi" data-modal-name="{{ $name }}" :data-initial-open="$show ? 'true' : 'false'">
    {{ $slot }}
</x-dialog>
