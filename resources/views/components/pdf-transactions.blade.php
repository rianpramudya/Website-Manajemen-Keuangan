@props(['transactions'])
@php
    preg_match_all('/(--pdf-[a-z-]+):\s*([0-9]+);/', file_get_contents(resource_path('css/app.css')), $matches, PREG_SET_ORDER);
    $limits = array_column($matches, 2, 1);
    $estimateLines = function ($transaction) use ($limits) {
        $categoryLines = ceil(mb_strlen($transaction->category->name ?? 'Umum') / $limits['--pdf-category-columns']) + 1;
        $descriptionLines = ceil(mb_strlen($transaction->description ?: 'Tanpa catatan') / $limits['--pdf-description-columns']);
        return max($categoryLines, $descriptionLines) + $limits['--pdf-row-padding-lines'];
    };
    $pages = $transactions->chunkWhile(fn ($transaction, $key, $chunk) => $chunk->sum($estimateLines) + $estimateLines($transaction) <= $limits['--pdf-row-budget']);
@endphp
@forelse($pages as $items)
<section class="history-page">
    <h2>Riwayat transaksi{{ $loop->first ? '' : ' (lanjutan)' }}</h2>
    <table><thead><tr><th class="date-col">Tanggal</th><th class="category-col">Kategori / tipe</th><th class="description-col">Catatan</th><th class="amount amount-col">Nominal</th></tr></thead><tbody>
    @foreach($items as $trx)
    <tr><td>{{ \Carbon\Carbon::parse($trx->date)->locale('id')->translatedFormat('j M Y') }}</td><td>{{ $trx->category->name ?? 'Umum' }}<br>{{ $trx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</td><td>{{ $trx->description ?: 'Tanpa catatan' }}</td><td class="amount"><x-money :value="$trx->type === 'income' ? $trx->amount : -$trx->amount" /></td></tr>
    @endforeach
    </tbody></table>
</section>
@empty
<h2>Riwayat transaksi</h2><p>Belum ada transaksi dalam periode ini.</p>
@endforelse
