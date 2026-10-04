@props(['transactions', 'deletable' => false])
@if($transactions->isNotEmpty())
<table class="finance-table">
    <caption class="sr-only">Daftar transaksi: kantong, catatan, tanggal, nominal{{ $deletable ? ', dan tindakan' : '' }}</caption>
    <thead><tr><th scope="col">Kantong dan catatan</th><th scope="col">Tanggal</th><th scope="col" class="amount-heading">Nominal</th>@if($deletable)<th scope="col">Tindakan</th>@endif</tr></thead>
    <tbody>
    @foreach($transactions as $trx)
    <tr class="transaction-row" data-transaction-id="{{ $trx->id }}">
        <td><x-badge :tone="$trx->type === 'income' ? 'success' : 'danger'" :icon="$trx->type === 'income' ? 'arrow-down-left' : 'arrow-up-right'">{{ $trx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</x-badge><h3 class="text-base break-words mt-3">{{ $trx->category->name ?? 'Umum' }}</h3><p class="muted mt-2">{{ $trx->description ?: 'Tanpa catatan' }}</p></td>
        <td data-label="Tanggal"><time class="muted" datetime="{{ $trx->date }}">{{ \Carbon\Carbon::parse($trx->date)->locale('id')->translatedFormat('j M Y') }}</time></td>
        <td class="amount-cell" data-label="Nominal"><x-money :value="$trx->type === 'income' ? $trx->amount : -$trx->amount" class="font-bold" /></td>
        @if($deletable)
        <td class="transaction-actions"><x-button variant="tertiary" :data-open-dialog="'deleteTransaction'.$trx->id" icon="trash" class="text-danger">Hapus transaksi</x-button>
            <x-dialog :id="'deleteTransaction'.$trx->id" title="Hapus transaksi?">
                <p class="mb-6">Transaksi {{ $trx->description ?: ($trx->category->name ?? 'Umum') }} akan dihapus dan saldo disesuaikan.</p>
                <form action="{{ route('transactions.destroy', $trx) }}" method="POST" class="actions" data-remove-id="{{ $trx->id }}">@csrf @method('DELETE')<x-button variant="secondary" data-close-dialog>Batal</x-button><x-button variant="danger" type="submit" icon="trash">Hapus transaksi</x-button></form>
            </x-dialog>
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
@else
    <x-empty-state title="Belum ada transaksi" text="Catat transaksi pertamamu agar rencana lebih mudah dipantau." />
@endif
