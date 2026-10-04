@props(['value', 'count' => false])
<span {{ $attributes->class(['money', 'count-up' => $count]) }} @if($count) data-count-up="{{ $value }}" @endif>{{ $value < 0 ? '-Rp ' : 'Rp ' }}{{ number_format(abs($value), 0, ',', '.') }}</span>
