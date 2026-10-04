@props(['transactions', 'deletable' => false])
<div>
@forelse($transactions as $trx)
    <article class="transaction-row" data-transaction-id="{{ $trx->id }}">
        <div class="flex items-start gap-3 min-w-0">
            <x-badge :tone="$trx->type === 'income' ? 'success' : 'danger'" :icon="$trx->type === 'income' ? 'arrow-down-left' : 'arrow-up-right'">{{ $trx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</x-badge>
            <div class="min-w-0"><h3 class="text-base break-words">{{ $trx->category->name ?? 'Umum' }}</h3><p class="muted">{{ $trx->description ?: 'Tanpa catatan' }}</p><time class="muted" datetime="{{ $trx->date }}">{{ \Carbon\Carbon::parse($trx->date)->locale('id')->translatedFormat('j M Y') }}</time></div>
        </div>
        <div class="sm:text-right min-w-0"><x-money :value="$trx->type === 'income' ? $trx->amount : -$trx->amount" class="font-bold" />
        @if($deletable)
            <x-button variant="tertiary" :data-open-dialog="'deleteTransaction'.$trx->id" icon="trash" class="text-danger mt-2">Hapus transaksi</x-button>
            <x-dialog :id="'deleteTransaction'.$trx->id" title="Hapus transaksi?">
                <p class="mb-6">Transaksi {{ $trx->description ?: ($trx->category->name ?? 'Umum') }} akan dihapus dan saldo disesuaikan.</p>
                <form action="{{ route('transactions.destroy', $trx) }}" method="POST" class="actions" data-remove-id="{{ $trx->id }}">@csrf @method('DELETE')<x-button variant="secondary" data-close-dialog>Batal</x-button><x-button variant="danger" type="submit" icon="trash">Hapus transaksi</x-button></form>
            </x-dialog>
        @endif
        </div>
    </article>
@empty
    <x-empty-state title="Belum ada transaksi" text="Catat transaksi pertamamu agar rencana lebih mudah dipantau." />
@endforelse
</div>
