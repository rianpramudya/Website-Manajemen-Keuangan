@props(['value', 'count' => false])
@php($formatted = str_replace('.', '.<wbr>', e(number_format(abs($value), floor(abs($value)) == abs($value) ? 0 : 2, ',', '.'))))
<span {{ $attributes->class(['money', 'count-up' => $count]) }} @if($count) data-count-up="{{ $value }}" @endif>{{ $value < 0 ? '-Rp ' : 'Rp ' }}<span class="money-digits">{!! $formatted !!}</span></span>
