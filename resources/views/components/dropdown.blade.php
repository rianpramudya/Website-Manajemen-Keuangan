@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'stack'])
<details {{ $attributes->class(['relative']) }}><summary class="cursor-pointer">{{ $trigger }}</summary><div class="panel absolute right-0 shadow-overlay {{ $contentClasses }}">{{ $content }}</div></details>
