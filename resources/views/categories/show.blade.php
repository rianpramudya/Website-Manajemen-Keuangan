<x-app-layout>
<div class="page">
    <header class="page-header" data-reveal><div><x-button :href="route('categories.index')" variant="tertiary" icon="arrow-left">Semua kantong</x-button><h1 class="break-words mt-3">{{ $category->name }}</h1><p class="muted mt-2">{{ $category->type === 'income' ? 'Kantong tabungan' : 'Kantong pengeluaran' }}</p></div><x-button variant="secondary" data-open-dialog="deletePocket" icon="trash">Hapus kantong</x-button></header>
    <section class="pocket stack" data-palette="yellow" data-pocket-id="{{ $category->id }}" data-reveal><span class="pocket-tab" aria-hidden="true"></span><h2>Saldo kantong</h2><x-money :value="$balance" :count="true" class="balance block" /></section>
    <div class="actions"><x-button data-open-dialog="modalIncome" icon="arrow-down-left">Tambah pemasukan</x-button><x-button variant="secondary" data-open-dialog="modalExpense" icon="arrow-up-right">Catat pengeluaran</x-button></div>
    <section class="panel stack"><h2>Aktivitas kantong</h2><x-transaction-list :transactions="$transactions" :deletable="true" /></section>
</div>
@foreach(['income' => ['modalIncome', 'Tambah pemasukan'], 'expense' => ['modalExpense', 'Catat pengeluaran']] as $type => [$id, $title])
<x-dialog :id="$id" :title="$title"><p class="muted mb-6">{{ $category->name }}</p><x-transaction-form :category="$category" :type="$type" :prefix="$id" /></x-dialog>
@endforeach
<x-dialog id="deletePocket" title="Hapus kantong ini?">
    <p class="mb-6">Kantong {{ $category->name }} dan semua transaksinya akan dihapus. Saldo keseluruhan akan disesuaikan.</p>
    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="actions">@csrf @method('DELETE')<x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit" variant="danger" icon="trash">Hapus kantong</x-button></form>
</x-dialog>
</x-app-layout>
