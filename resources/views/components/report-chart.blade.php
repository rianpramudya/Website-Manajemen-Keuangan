@props(['values', 'total'])
<svg class="report-plot" viewBox="0 0 100 100" preserveAspectRatio="none" role="img" aria-label="Komposisi pengeluaran; nama kategori, nominal, dan persentase lengkap tersedia di bawah">
    <title>Komposisi pengeluaran</title>
    @foreach($values as $index => $value)
    @php
        $slotWidth = 100 / max(1, count($values));
        $height = $total > 0 ? min(100, max(0, ($value / $total) * 100)) : 0;
        $palette = ['teal', 'violet', 'orange', 'sky', 'lime', 'indigo', 'stone', 'yellow'][$index % 8];
    @endphp
    <rect class="chart-bar" data-chart-bar data-chart-index="{{ $index }}" data-palette="{{ $palette }}" x="{{ ($index + .175) * $slotWidth }}" y="{{ 100 - $height }}" width="{{ $slotWidth * .65 }}" height="{{ $height }}" rx="1" />
    @endforeach
</svg>
