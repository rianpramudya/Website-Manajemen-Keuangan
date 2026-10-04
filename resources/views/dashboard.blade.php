<x-app-layout>
<div class="page">
    <header class="page-header" data-reveal><div><h1>Halo, {{ auth()->user()->name }}</h1><p class="muted mt-2">Catatan kecil hari ini, rencana lebih tenang nanti.</p></div><x-action-bar><x-button href="#create-transaction" icon="plus">Tambah transaksi</x-button></x-action-bar></header>
    <section class="pocket summary-panel" data-palette="yellow" aria-labelledby="balance-title" data-reveal>
        <span class="pocket-tab" aria-hidden="true"></span>
        <div class="page-header"><div class="stack"><h2 id="balance-title">Saldo keseluruhan</h2><x-money :value="$balance" :count="true" class="balance block" /></div><x-button variant="secondary" data-open-dialog="transferModal" icon="arrows-left-right">Transfer dana</x-button></div>
    </section>
    <div class="grid sm:grid-cols-2 gap-6" data-reveal><section class="panel stack"><x-badge tone="success" icon="arrow-down-left">Pemasukan</x-badge><x-money :value="$totalIncome" class="text-2xl font-extrabold block" :count="true" /></section><section class="panel stack"><x-badge tone="danger" icon="arrow-up-right">Pengeluaran</x-badge><x-money :value="$totalExpense" class="text-2xl font-extrabold block" :count="true" /></section></div>
    <section class="stack" aria-labelledby="pockets-title">
        <div class="page-header"><div><h2 id="pockets-title">Kantongmu, rencanamu</h2><p class="muted mt-2">Pisahkan kebutuhan, tetap lihat gambaran besarnya.</p></div><div class="actions"><x-button variant="tertiary" :href="route('categories.index')">Lihat semua kantong</x-button><x-button variant="secondary" data-open-dialog="categoryModal" icon="plus">Buat kantong</x-button></div></div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">@forelse($displayPockets as $cat)<x-pocket-card :category="$cat" />@empty<x-empty-state title="Kantong pertamamu menunggu" text="Buat tempat untuk tabungan atau kebutuhan harianmu." class="md:col-span-2 lg:col-span-3" />@endforelse</div>
    </section>
    <div class="grid lg:grid-cols-2 gap-8 items-start">
        <section id="create-transaction" class="panel stack" data-reveal><h2>Tambah transaksi</h2><p class="muted">Uang masuk atau keluar, catat selagi ingat.</p><x-transaction-form :categories="$categories" /></section>
        <section class="panel stack" data-reveal><div class="page-header"><h2>Transaksi terbaru</h2><x-button variant="tertiary" :href="route('transactions.history')">Lihat riwayat</x-button></div><x-transaction-list :transactions="$transactions" /></section>
    </div>
</div>
@include('components.modals.create-category')
<x-dialog id="transferModal" title="Transfer dana">
    <p class="muted mb-6">Pindahkan saldo ke kantong yang membutuhkan.</p>
    <form action="{{ route('transactions.transfer') }}" method="POST" class="stack" data-finance-event="transfer">
        @csrf
        <x-money-input id="transfer-amount" required />
        @foreach(['from_category_id' => 'Kantong asal', 'to_category_id' => 'Kantong tujuan'] as $name => $label)
        <div><x-input-label :for="$name" :value="$label" /><select id="{{ $name }}" name="{{ $name }}" class="field" required><option value="">Pilih kantong</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old($name) == $cat->id)>{{ $cat->name }} — {{ $cat->balance < 0 ? '-Rp ' : 'Rp ' }}{{ number_format(abs($cat->balance), 0, ',', '.') }}</option>@endforeach</select><x-input-error :messages="$errors->get($name)" /></div>
        @endforeach
        <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
        <div class="actions"><x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit" icon="arrows-left-right">Transfer dana</x-button></div>
    </form>
</x-dialog>
</x-app-layout>
