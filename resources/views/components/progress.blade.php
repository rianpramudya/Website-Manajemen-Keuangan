@props(['value' => 0, 'label' => 'Progres'])
<svg class="progress-track" viewBox="0 0 100 1" preserveAspectRatio="none" role="img" aria-label="{{ $label }}: {{ number_format(max(0, min(100, $value)), 1, ',', '.') }}%"><rect class="progress-fill" width="{{ max(0, min(100, $value)) }}" height="1" data-progress="{{ max(0, min(100, $value)) }}" /></svg>
