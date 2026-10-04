<x-app-layout>
<div class="page">
    <header class="page-header" data-reveal><div><h1>Riwayat transaksi</h1><p class="muted mt-2">Lihat kembali perjalanan uangmu.</p></div><x-button :href="route('dashboard').'#create-transaction'" icon="plus">Tambah transaksi</x-button></header>
    <div class="grid lg:grid-cols-2 gap-8">
    @foreach([['Pemasukan', 'success', $totalIncome, $incomeTransactions], ['Pengeluaran', 'danger', $totalExpense, $expenseTransactions]] as [$label, $tone, $total, $items])
        <section class="panel stack" data-reveal><div class="page-header"><x-badge :tone="$tone" :icon="$tone === 'success' ? 'arrow-down-left' : 'arrow-up-right'">{{ $label }}</x-badge><x-money :value="$total" class="text-2xl font-extrabold" /></div><x-transaction-list :transactions="$items" :deletable="true" /></section>
    @endforeach
    </div>
</div>
</x-app-layout>
