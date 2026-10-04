<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Laporan keuangan Dompet Rantau</title><x-pdf-styles /></head>
<body>
    <div class="report-header"><h1>Dompet Rantau</h1><p>Laporan keuangan · {{ strtr($monthName, ['May' => 'Mei', 'Aug' => 'Agu', 'Oct' => 'Okt', 'Dec' => 'Des']) }}</p><p class="muted">Pemilik: {{ $user->name }}</p></div>
    <h2>Ringkasan periode</h2>
    <table class="summary"><tr><td>Pemasukan<strong><x-money :value="$totalIncome" /></strong></td><td>Pengeluaran<strong><x-money :value="$totalExpense" /></strong></td><td>Arus kas bersih<strong><x-money :value="$cashflow" /></strong></td></tr></table>
    <h2>Rincian pengeluaran per kategori</h2>
    <table><thead><tr><th>Kategori</th><th class="amount">Total</th><th class="amount">Persentase</th></tr></thead><tbody>@forelse($expenseByCategory as $cat)<tr><td>{{ $cat->category->name ?? 'Lainnya' }}</td><td class="amount"><x-money :value="$cat->total" /></td><td class="amount">{{ number_format($totalExpense > 0 ? ($cat->total / $totalExpense) * 100 : 0, 1, ',', '.') }}%</td></tr>@empty<tr><td colspan="3">Belum ada pengeluaran dalam periode ini.</td></tr>@endforelse</tbody></table>
    <x-pdf-transactions :transactions="$transactions" />
    <p class="footer">Dicetak pada {{ now()->locale('id')->translatedFormat('j M Y H:i') }} oleh Dompet Rantau.</p>
</body>
</html>
