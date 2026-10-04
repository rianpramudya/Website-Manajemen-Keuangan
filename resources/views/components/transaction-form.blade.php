@props(['categories' => null, 'category' => null, 'type' => null, 'prefix' => 'transaction', 'first' => false])
<form action="{{ route('transactions.store') }}" method="POST" class="stack" data-finance-event="transaction" data-first-transaction="{{ $first ? 'true' : 'false' }}">
    @csrf
    @if($type)<input type="hidden" name="type" value="{{ $type }}">@else
    <fieldset><legend class="field-label">Tipe transaksi</legend><div class="actions"><label class="btn btn-secondary"><input type="radio" name="type" value="expense" @checked(old('type', 'expense') === 'expense')> Pengeluaran</label><label class="btn btn-secondary"><input type="radio" name="type" value="income" @checked(old('type') === 'income')> Pemasukan</label></div><x-input-error :messages="$errors->get('type')" /></fieldset>
    @endif
    <x-money-input :id="$prefix.'-amount'" required />
    @if($category)<input type="hidden" name="category_id" value="{{ $category->id }}">@else
    <div><x-input-label :for="$prefix.'-category'" value="Pilih kantong" /><select name="category_id" id="{{ $prefix }}-category" class="field" required><option value="">Pilih kantong</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>@endforeach</select><x-input-error :messages="$errors->get('category_id')" /></div>
    @endif
    <x-field name="date" :id="$prefix.'-date'" label="Tanggal" type="date" :value="date('Y-m-d')" required />
    <x-field name="description" :id="$prefix.'-description'" label="Catatan (opsional)" placeholder="Untuk keperluan apa?" />
    <x-button type="submit" icon="check">Simpan transaksi</x-button>
</form>
