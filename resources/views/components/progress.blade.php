@props(['value' => 0, 'label' => 'Progres'])
<div class="progress-track" role="progressbar" aria-label="{{ $label }}" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ max(0, min(100, $value)) }}">
    <div class="progress-fill" data-progress="{{ max(0, min(100, $value)) }}"></div>
</div>
