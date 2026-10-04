@props(['kind' => 'empty'])
<svg {{ $attributes->class(['pocket-illustration']) }} viewBox="0 0 320 240" fill="none" aria-hidden="true" focusable="false">
    <ellipse cx="160" cy="216" rx="112" ry="10" class="illustration-shadow" />
    <path d="M71 78V57c0-10 8-18 18-18h64l22 25" class="illustration-tab" />
    <path d="M58 84c0-11 9-20 20-20h164c11 0 20 9 20 20v103c0 17-13 30-30 30H88c-17 0-30-13-30-30V84Z" class="illustration-pocket" />
    <path d="M71 85c0-5 4-8 9-8h160c5 0 9 3 9 8v100c0 10-8 19-19 19H90c-11 0-19-9-19-19V85Z" class="illustration-stitch" />
    <path d="M262 109h-62c-10 0-18 8-18 18v25c0 10 8 18 18 18h62" class="illustration-flap" />
    <circle cx="209" cy="140" r="8" class="illustration-button" />
    @if($kind === 'full')
    <g class="illustration-coins"><circle cx="122" cy="61" r="25" /><circle cx="176" cy="38" r="27" /><path d="M118 48v24m-6-18h12m46-30v27m-7-21h14" /></g>
    <path d="m271 42 7-13 7 13 14 7-14 7-7 13-7-13-14-7 14-7ZM37 120l5-9 5 9 9 5-9 5-5 9-5-9-9-5 9-5Z" class="illustration-spark" />
    @elseif($kind === 'coins')
    <g class="illustration-coins"><circle cx="99" cy="170" r="25" /><circle cx="130" cy="186" r="22" /><path d="M98 157v26m-7-20h14m25 11v24m-6-17h12" /></g>
    @else
    <path d="M99 120h48m-48 17h33" class="illustration-line" /><path d="m116 42 7-11m-27 8-4-12" class="illustration-line" />
    @endif
</svg>
