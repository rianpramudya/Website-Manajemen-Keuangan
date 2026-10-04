@props(['bill' => null, 'prefix' => 'bill'])
<form action="{{ $bill ? route('bills.update', $bill) : route('bills.store') }}" method="POST" class="stack">
    @csrf @if($bill) @method('PUT') @endif
    <x-field name="name" :id="$prefix.'-name'" label="Nama tagihan" :value="$bill?->name" required />
    <x-money-input :id="$prefix.'-amount'" :value="$bill?->amount" required />
    <x-field name="due_date" :id="$prefix.'-due'" type="number" label="Tanggal jatuh tempo (opsional)" :value="$bill?->due_date" min="1" max="31" />
    <div><x-input-label :for="$prefix.'-frequency'" value="Frekuensi" /><select class="field" id="{{ $prefix }}-frequency" name="frequency" required>@foreach(['monthly' => 'Bulanan', 'weekly' => 'Mingguan', 'one_time' => 'Sekali'] as $value => $label)<option value="{{ $value }}" @selected(old('frequency', $bill?->frequency ?? 'monthly') === $value)>{{ $label }}</option>@endforeach</select><x-input-error :messages="$errors->get('frequency')" /></div>
    <div class="actions"><x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit">{{ $bill ? 'Simpan perubahan' : 'Tambah tagihan' }}</x-button></div>
</form>
