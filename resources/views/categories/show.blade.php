<x-app-layout>
<div class="page">
    <header class="page-header" data-reveal><div><x-button :href="route('categories.index')" variant="tertiary" icon="arrow-left">Semua kantong</x-button><h1 class="break-words mt-3">{{ $category->name }}</h1><p class="muted mt-2">{{ $category->type === 'income' ? 'Kantong tabungan' : 'Kantong pengeluaran' }}</p></div><x-button variant="secondary" data-open-dialog="deletePocket" icon="trash">Hapus kantong</x-button></header>
    <section class="pocket stack" data-palette="{{ ['yellow', 'teal', 'violet', 'orange', 'sky', 'lime', 'indigo', 'stone'][(int) $category->id % 8] }}" data-pocket-id="{{ $category->id }}" data-reveal><span class="pocket-tab" aria-hidden="true"></span><h2>Saldo kantong</h2><x-money :value="$balance" :count="true" class="balance block" /></section>
    <x-action-bar><x-button data-open-dialog="modalIncome" icon="arrow-down-left">Tambah pemasukan</x-button><x-button variant="secondary" data-open-dialog="modalExpense" icon="arrow-up-right">Catat pengeluaran</x-button></x-action-bar>
    <div class="pocket-detail" data-tabs>
        <div class="tab-list" hidden data-tab-list><x-button id="pocket-history-tab" variant="tertiary" data-tab aria-controls="pocket-history">Riwayat</x-button><x-button id="pocket-info-tab" variant="tertiary" data-tab aria-controls="pocket-info">Info kantong</x-button></div>
        <section class="panel stack" id="pocket-history" data-tab-panel aria-labelledby="pocket-history-tab"><h2>Aktivitas kantong</h2><x-transaction-list :transactions="$transactions" :deletable="true" /></section>
        <section class="panel stack" id="pocket-info" data-tab-panel aria-labelledby="pocket-info-tab"><h2>Tentang kantong ini</h2><dl class="stack"><div><dt class="muted">Nama kantong</dt><dd class="font-bold break-words">{{ $category->name }}</dd></div><div><dt class="muted">Jenis kantong</dt><dd>{{ $category->type === 'income' ? 'Tabungan' : 'Pengeluaran' }}</dd></div><div><dt class="muted">Saldo saat ini</dt><dd><x-money :value="$balance" class="font-bold" /></dd></div></dl><p class="muted">Catat pemasukan dan pengeluaran dari tombol di atas. Semua aktivitas tersimpan di riwayat kantong.</p></section>
    </div>
</div>
@foreach(['income' => ['modalIncome', 'Tambah pemasukan'], 'expense' => ['modalExpense', 'Catat pengeluaran']] as $type => [$id, $title])
<x-dialog :id="$id" :title="$title"><p class="muted mb-6">{{ $category->name }}</p><x-transaction-form :category="$category" :type="$type" :prefix="$id" /></x-dialog>
@endforeach
<x-dialog id="deletePocket" title="Hapus kantong ini?">
    <p class="mb-6">Kantong {{ $category->name }} dan semua transaksinya akan dihapus. Saldo keseluruhan akan disesuaikan.</p>
    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="actions">@csrf @method('DELETE')<x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit" variant="danger" icon="trash">Hapus kantong</x-button></form>
</x-dialog>
</x-app-layout>
