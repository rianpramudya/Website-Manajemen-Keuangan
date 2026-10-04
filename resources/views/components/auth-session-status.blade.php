@props(['status'])
@if($status)<p role="status" {{ $attributes->class(['badge badge-success']) }}>{{ $status }}</p>@endif
