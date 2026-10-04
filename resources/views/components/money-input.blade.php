@props(['name' => 'amount', 'id' => 'amount', 'label' => 'Nominal', 'value' => null])
<div>
    <x-input-label :for="$id" :value="$label" />
    <div class="money-field">
        <span aria-hidden="true">Rp</span>
        <input class="field money" type="text" inputmode="numeric" autocomplete="off" data-money-input id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}" aria-describedby="{{ $id }}-help {{ $id }}-error" aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" {{ $attributes }}>
    </div>
    <p id="{{ $id }}-help" class="muted mt-2">Masukkan rupiah; gunakan koma bila ada pecahan.</p>
    <noscript><p class="muted">Tanpa JavaScript, masukkan angka tanpa pemisah ribuan dan gunakan titik untuk pecahan.</p></noscript>
    <x-input-error :id="$id.'-error'" :messages="$errors->get($name)" />
</div>
