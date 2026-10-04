<x-dialog id="categoryModal" title="Buat kantong">
    <p class="muted mb-6">Beri setiap rencana tempatnya sendiri.</p>
    <form action="{{ route('categories.store') }}" method="POST" class="stack">
        @csrf
        <x-field name="name" id="category-name" label="Nama kantong" placeholder="Jajan atau laundry" required />
        <div><x-input-label for="category-type" value="Tipe kantong" /><select id="category-type" name="type" class="field" required><option value="expense" @selected(old('type') === 'expense')>Kantong pengeluaran</option><option value="income" @selected(old('type') === 'income')>Kantong tabungan</option></select><x-input-error :messages="$errors->get('type')" /></div>
        <div class="actions"><x-button variant="secondary" data-close-dialog>Batal</x-button><x-button type="submit">Buat kantong</x-button></div>
    </form>
</x-dialog>
