@props(['active' => false])
<a {{ $attributes->class(['nav-link']) }} @if($active) aria-current="page" @endif>{{ $slot }}</a>
