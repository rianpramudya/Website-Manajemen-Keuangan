<dialog id="categoryModal" class="modal p-0 rounded-[2rem] shadow-2xl backdrop:bg-slate-900/40 w-full max-w-md open:animate-fade-in-up">
    <div class="bg-white p-8 text-center">
        <h3 class="text-2xl font-bold text-slate-900 mb-2">Buat Kantong Baru</h3>
        <p class="text-slate-500 mb-6 text-sm">Pisahkan uangmu agar lebih teratur.</p>
        
        <form action="{{ route('categories.store') }}" method="POST" class="text-left space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Nama Kantong</label>
                <input type="text" name="name" placeholder="Contoh: Jajan, Laundry" class="w-full p-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:bg-white transition" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Tipe Kantong</label>
                <select name="type" class="w-full p-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:bg-white transition" required>
                    <option value="expense">Kantong Bayar (Pengeluaran)</option>
                    <option value="income">Kantong Nabung (Pemasukan)</option>
                </select>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('categoryModal').close()" class="flex-1 py-3 rounded-xl bg-slate-100 font-bold text-slate-500 hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-amber-400 text-white font-bold hover:bg-amber-500 shadow-lg shadow-amber-400/30 transition transform hover:-translate-y-1">Simpan</button>
            </div>
        </form>
    </div>
</dialog>