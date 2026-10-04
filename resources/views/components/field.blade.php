@props(['name', 'label', 'type' => 'text', 'value' => null, 'id' => null, 'bag' => 'default'])
@php($fieldId = $id ?? $name)
<div>
    <x-input-label :for="$fieldId" :value="$label" />
    <x-text-input :id="$fieldId" :name="$name" :type="$type" :value="$type === 'password' ? null : old($name, $value)" :aria-invalid="$errors->getBag($bag)->has($name) ? 'true' : 'false'" :aria-describedby="$fieldId.'-error'" {{ $attributes }} />
    <x-input-error :id="$fieldId.'-error'" :messages="$errors->getBag($bag)->get($name)" />
</div>
