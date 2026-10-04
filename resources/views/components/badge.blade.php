@props(['tone' => 'neutral', 'icon' => null])
<span {{ $attributes->class(['badge', 'badge-'.$tone]) }}>@if($icon)<x-icon :name="$icon" />@endif{{ $slot }}</span>
