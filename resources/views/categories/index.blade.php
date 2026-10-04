<x-app-layout>
<div class="page">
    <header class="page-header" data-reveal><div><h1>Kantongmu, warna rencanamu</h1><p class="muted mt-2">Satu tempat untuk setiap kebutuhan.</p></div><x-action-bar><x-button data-open-dialog="categoryModal" icon="plus">Buat kantong</x-button></x-action-bar></header>
    <div><x-input-label for="pocket-search" value="Cari kantong" /><input id="pocket-search" type="search" class="field" data-pocket-search placeholder="Ketik nama kantong"></div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" data-pocket-grid>
        @forelse($categories as $cat)<x-pocket-card :category="$cat" data-search-name="{{ $cat->name }}" />@empty<x-empty-state title="Belum ada kantong" text="Buat kantong pertama untuk menata tabungan atau kebutuhanmu." class="md:col-span-2 lg:col-span-4" />@endforelse
    </div>
    <p data-pocket-no-results hidden class="panel">Kantong tidak ditemukan. Coba nama lain.</p>
</div>
@include('components.modals.create-category')
</x-app-layout>
