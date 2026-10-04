<x-app-layout>
@php
    $unpaidBills = $bills->whereIn('status', ['unpaid', 'partial']);
    $paidBills = $bills->where('status', 'paid');
    $bulkRows = $unpaidBills->map(fn ($bill) => ['id' => $bill->id, 'name' => $bill->name, 'original_total' => $bill->remaining_amount, 'pay_amount' => $bill->remaining_amount, 'percent' => 100, 'selected' => false])->values();
@endphp
<div class="page">
    <header class="page-header" data-reveal><div><h1>Tagihan tertata, pikiran lega</h1><p class="muted mt-2">Kelola kewajiban dan catat pembayaranmu.</p></div><x-button data-open-dialog="createBillModal" icon="plus">Tambah tagihan</x-button></header>
    <section class="pocket" data-palette="yellow" data-reveal><span class="pocket-tab" aria-hidden="true"></span><div class="page-header"><div class="stack"><h2>Saldo bersih tersedia</h2><x-money :value="$currentBalance" class="balance block" :count="true" /><p class="muted">Saldo dari kantong tabungan.</p></div><x-button variant="secondary" data-open-dialog="addFundsModal" icon="plus">Tambah saldo</x-button></div></section>
    <section class="stack" aria-labelledby="active-bills-title"><div class="page-header"><h2 id="active-bills-title">Tagihan aktif</h2><div><x-input-label for="bill-filter" value="Frekuensi tagihan" /><select class="field" id="bill-filter" data-bill-filter><option value="all">Semua</option><option value="monthly">Bulanan</option><option value="weekly">Mingguan</option><option value="one_time">Sekali</option></select></div></div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($unpaidBills as $bill)
        @php($overdue = $bill->frequency === 'monthly' && $bill->due_date && now()->day > $bill->due_date)
        <article class="panel stack" data-bill-id="{{ $bill->id }}" data-bill-frequency="{{ $bill->frequency }}" @if(!$overdue) data-reveal @endif>
            <div class="flex justify-between items-start gap-3"><x-icon name="receipt" class="text-primary text-2xl" /><x-badge :tone="$overdue ? 'danger' : ($bill->status === 'partial' ? 'warning' : 'info')" :icon="$overdue ? 'warning-circle' : 'clock'">{{ $overdue ? 'Jatuh tempo terlewat' : ($bill->status === 'partial' ? 'Dibayar sebagian' : 'Belum dibayar') }}</x-badge></div>
            <h3 class="break-words">{{ $bill->name }}</h3><p class="muted">{{ ['monthly' => 'Bulanan', 'weekly' => 'Mingguan', 'one_time' => 'Sekali'][$bill->frequency] ?? $bill->frequency }}@if($bill->due_date) · Jatuh tempo tanggal {{ $bill->due_date }}@endif</p>
            <div><p class="muted mb-2">Sisa tagihan</p><x-money :value="$bill->remaining_amount" class="text-2xl font-extrabold block" /></div>
            <x-progress :value="$bill->amount > 0 ? ($bill->paid_amount / $bill->amount) * 100 : 0" :label="'Pembayaran '.$bill->name" />
            <p class="muted">Terbayar <x-money :value="$bill->paid_amount" /> dari <x-money :value="$bill->amount" />.</p>
            <div class="actions"><x-button :data-open-dialog="'payBill'.$bill->id" icon="check">Bayar tagihan</x-button><x-button variant="tertiary" :data-open-dialog="'editBill'.$bill->id">Edit</x-button><x-button variant="tertiary" :data-open-dialog="'deleteBill'.$bill->id" class="text-danger">Hapus</x-button></div>
        </article>
        @empty<x-empty-state title="Tidak ada tagihan aktif" text="Semua tagihan tercatat sudah lunas, atau tambahkan tagihan pertamamu." class="md:col-span-2 lg:col-span-3" icon="receipt" />@endforelse
        </div>
        <p data-bill-no-results hidden class="panel">Tidak ada tagihan untuk frekuensi ini.</p>
    </section>
    <section class="panel stack"><h2>Riwayat lunas</h2>@forelse($paidBills as $bill)<article class="transaction-row" data-paid-bill="{{ $bill->id }}"><div><h3>{{ $bill->name }}</h3><p class="muted">Pembayaran tercatat pada bulan ini.</p></div><div class="actions"><x-money :value="$bill->amount" class="font-bold" /><x-badge tone="success" icon="check-circle">Lunas</x-badge><x-button variant="tertiary" :data-open-dialog="'editBill'.$bill->id">Edit</x-button><x-button variant="tertiary" :data-open-dialog="'deleteBill'.$bill->id" class="text-danger">Hapus</x-button></div></article>@empty<x-empty-state title="Belum ada tagihan lunas" text="Pembayaran yang sudah lengkap akan tampil di sini." icon="check-circle" />@endforelse</section>
    @if($unpaidBills->isNotEmpty())
    <section class="panel stack" x-data="billTable(@js($bulkRows), @js(date('Y-m-d')))">
        <h2>Bayar beberapa tagihan</h2><p class="muted">Pilih tagihan dan sesuaikan nominal. Perkiraan di bawah belum merupakan pembayaran.</p>
        <form action="{{ route('bills.bulkPay') }}" method="POST" class="stack" data-finance-event="bulk-pay">
            @csrf
            <x-field name="date" id="bulk-date" label="Tanggal pembayaran" type="date" :value="date('Y-m-d')" x-model="paymentDate" required />
            <label class="btn btn-secondary" data-js-control><input type="checkbox" @change="toggleAll($event)"> Pilih semua</label>
            @foreach($unpaidBills->values() as $index => $bill)
            <div class="bulk-row">
                <div><label class="field-label flex gap-3 items-start"><input type="checkbox" name="payments[{{ $index }}][selected]" value="1" x-model="rows[{{ $index }}].selected">{{ $bill->name }}</label><input type="hidden" name="payments[{{ $index }}][bill_id]" value="{{ $bill->id }}"><p class="muted">Sisa awal: <x-money :value="$bill->remaining_amount" /></p></div>
                <div class="grid sm:grid-cols-2 gap-4"><x-money-input :name="'payments['.$index.'][amount]'" :id="'bulk-amount-'.$bill->id" label="Nominal pembayaran" :value="$bill->remaining_amount" x-bind:value="formatNumber(rows[{{ $index }}].pay_amount)" x-on:input="rows[{{ $index }}].pay_amount = Number($event.target.value.replaceAll('.', '').replace(',', '.')); updatePercentFromAmount(rows[{{ $index }}])" /><div data-js-control><x-input-label :for="'bulk-percent-'.$bill->id" value="Persentase pembayaran" /><input class="field" id="bulk-percent-{{ $bill->id }}" type="number" min="0" step="0.1" x-model.number="rows[{{ $index }}].percent" @input="updateAmountFromPercent(rows[{{ $index }}])"></div></div>
                <div data-js-control><p class="muted">Perkiraan sisa</p><p class="font-bold money" x-text="'Rp ' + formatNumber(calculateRemaining(rows[{{ $index }}]))"></p><p class="muted" x-text="'Perkiraan: ' + getStatusText(rows[{{ $index }}])"></p></div>
            </div>
            @endforeach
            <div class="page-header"><div><p class="muted">Menggunakan saldo bersih dari kantong tabungan.</p><p data-js-control class="font-bold money">Total pilihan: Rp <span x-text="formatNumber(grandTotal)">0</span></p></div><x-button type="submit" x-bind:disabled="grandTotal <= 0" icon="check">Bayar pilihan</x-button></div>
        </form>
    </section>
    @endif
</div>
<x-dialog id="createBillModal" title="Tambah tagihan"><x-bill-form /></x-dialog>
<x-dialog id="addFundsModal" title="Tambah saldo"><form action="{{ route('bills.addFunds') }}" method="POST" class="stack" data-finance-event="income">@csrf<x-money-input id="funds-amount" required /><div class="actions"><x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit">Tambah saldo</x-button></div></form></x-dialog>
@foreach($bills as $bill)
<x-dialog :id="'editBill'.$bill->id" :title="'Edit tagihan: '.$bill->name"><x-bill-form :bill="$bill" :prefix="'edit-'.$bill->id" /></x-dialog>
<x-dialog :id="'deleteBill'.$bill->id" title="Hapus tagihan?"><p class="mb-6">Tagihan {{ $bill->name }} akan dihapus dari daftar.</p><form action="{{ route('bills.destroy', $bill) }}" method="POST" class="actions" data-finance-event="delete-bill" data-bill-id="{{ $bill->id }}">@csrf @method('DELETE')<x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit" variant="danger">Hapus tagihan</x-button></form></x-dialog>
@if($bill->status !== 'paid')
<x-dialog :id="'payBill'.$bill->id" :title="'Bayar tagihan: '.$bill->name">
    <form action="{{ route('bills.pay', $bill) }}" method="POST" class="stack" data-finance-event="pay" data-bill-id="{{ $bill->id }}">
        @csrf
        <x-money-input :id="'pay-amount-'.$bill->id" :value="$bill->remaining_amount" required />
        <x-field name="date" :id="'pay-date-'.$bill->id" label="Tanggal pembayaran" type="date" :value="date('Y-m-d')" required />
        <div><x-input-label :for="'pay-source-'.$bill->id" value="Sumber dana" /><select class="field" name="category_id" id="pay-source-{{ $bill->id }}"><option value="">Kantong tabungan utama (otomatis)</option>@foreach($fundingSources as $source)<option value="{{ $source->id }}" @selected(old('category_id') == $source->id)>{{ $source->name }}</option>@endforeach</select><x-input-error :messages="$errors->get('category_id')" /></div>
        <div class="actions"><x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit" icon="check">Bayar tagihan</x-button></div>
    </form>
</x-dialog>
@endif
@endforeach
</x-app-layout>
