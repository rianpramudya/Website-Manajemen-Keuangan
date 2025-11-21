<x-app-layout>
    <div class="min-h-screen bg-slate-50 pb-20 font-sans relative overflow-x-hidden">

        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-slate-200/50 to-transparent -z-10 pointer-events-none">
        </div>

        <!-- Warna Glow Dinamis Berdasarkan Tipe Kantong -->
        <div class="absolute top-[-150px] right-[-100px] w-96 h-96 rounded-full blur-3xl -z-10 opacity-40 
            {{ $category->type == 'income' ? 'bg-emerald-200' : 'bg-rose-200' }}"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- HEADER NAVIGASI CERDAS -->
            <div class="flex items-center justify-between mb-8">
                @php
                // LOGIKA NAVIGASI CERDAS
                // 1. Ambil URL sebelumnya
                $previousUrl = url()->previous();
                $currentUrl = url()->current();

                // 2. Tentukan URL Back:
                // Jika user me-refresh halaman (prev == current), kembalikan ke Dashboard.
                // Jika tidak, kembalikan ke halaman sebelumnya (bisa Dashboard atau List Kantong).
                $backUrl = ($previousUrl == $currentUrl) ? route('dashboard') : $previousUrl;
                @endphp

                <a href="{{ $backUrl }}"
                    class="group flex items-center gap-2 text-slate-500 hover:text-slate-900 transition">
                    <div
                        class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:shadow-md transition group-hover:-translate-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <span class="font-bold text-sm">Kembali</span>
                </a>

                <!-- Menu Pengaturan (Hapus) -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:border-rose-200 shadow-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>

                    <div x-show="open"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-20"
                        style="display: none;">
                        <div class="px-4 py-2 border-b border-slate-50">
                            <p class="text-xs font-bold text-slate-400 uppercase">Pengaturan</p>
                        </div>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kantong ini? Data transaksi akan ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm font-bold text-rose-500 hover:bg-rose-50 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Hapus Kantong
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- HERO CARD (Saldo & Nama Kantong) -->
            <div
                class="relative bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/20 overflow-hidden text-white mb-8 group">
                <div class="absolute top-0 right-0 w-64 h-64 rounded-full blur-3xl opacity-20 transition duration-500
                    {{ $category->type == 'income' ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10">
                </div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <div
                        class="w-20 h-20 rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center text-4xl mb-6 border border-white/10 shadow-inner">
                        <!-- ICON UTAMA -->
                        @if($category->type == 'income')
                        <i class="ph ph-cardholder"></i>
                        @else
                        <i class="ph ph-currency-circle-dollar"></i>
                        @endif
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight mb-1">{{ $category->name }}</h1>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-6">
                        Kantong {{ $category->type == 'income' ? 'Tabungan' : 'Pengeluaran' }}
                    </p>
                    <div class="py-3 px-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <p class="text-xs text-slate-400 font-bold mb-1">Sisa Saldo</p>
                        <h2 class="text-5xl font-extrabold tracking-tight">
                            Rp {{ number_format($balance, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="grid grid-cols-2 gap-4 mb-10">
                <button onclick="document.getElementById('modalIncome').showModal()"
                    class="group relative overflow-hidden bg-white p-6 rounded-[2rem] border border-emerald-100 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300 text-left">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-6 -mt-6 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg">Isi Uang</h3>
                        <p class="text-xs text-slate-400 mt-1">Tambah saldo masuk</p>
                    </div>
                </button>

                <button onclick="document.getElementById('modalExpense').showModal()"
                    class="group relative overflow-hidden bg-white p-6 rounded-[2rem] border border-rose-100 shadow-sm hover:shadow-lg hover:border-rose-200 transition-all duration-300 text-left">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-rose-50 rounded-bl-full -mr-6 -mt-6 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center text-rose-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg">Pakai Uang</h3>
                        <p class="text-xs text-slate-400 mt-1">Catat pengeluaran</p>
                    </div>
                </button>
            </div>

            <!-- RIWAYAT TRANSAKSI -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-slate-800 text-xl">Riwayat Aktivitas</h3>
                    <span class="text-xs font-bold bg-slate-100 text-slate-500 px-3 py-1 rounded-full">Terbaru</span>
                </div>

                <div class="space-y-4">
                    @forelse($transactions as $trx)
                    <div
                        class="flex items-center justify-between p-4 rounded-3xl hover:bg-slate-50 transition group border border-transparent hover:border-slate-100">
                        <div class="flex items-center gap-4 overflow-hidden">
                            <div
                                class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0
                                {{ $trx->type == 'income' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                @if($trx->type == 'income')
                                <i class="ph ph-cardholder text-lg"></i>
                                @else
                                <i class="ph ph-currency-circle-dollar text-lg"></i>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-slate-800 truncate">{{ $trx->description ?: 'Transaksi' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{
                                    \Carbon\Carbon::parse($trx->date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="font-bold {{ $trx->type == 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $trx->type == 'income' ? '+' : '-' }} {{ number_format($trx->amount, 0, ',', '.') }}
                            </p>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                                class="inline-block mt-1" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button
                                    class="text-[10px] text-slate-300 hover:text-rose-500 font-bold transition">HAPUS</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl grayscale opacity-50">
                            📭</div>
                        <p class="text-slate-400 text-sm font-bold">Belum ada transaksi di kantong ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 1: ISI KANTONG (INCOME) -->
    <dialog id="modalIncome"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/50 w-full max-w-sm open:animate-fade-in-up">
        <div class="bg-white p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-900 mb-1">Isi Kantong</h3>
                <p class="text-slate-500 text-sm mb-6">Masukkan uang ke {{ $category->name }}</p>
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="income">
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-xl font-bold text-emerald-500">Rp</span>
                        <input type="number" name="amount" placeholder="0"
                            class="w-full pl-12 pr-4 py-4 text-3xl font-bold text-slate-800 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 placeholder:text-slate-300 text-center"
                            required>
                    </div>
                    <input type="text" name="description" placeholder="Catatan (Opsional)"
                        class="w-full p-4 rounded-2xl bg-slate-50 border-none text-sm font-medium focus:ring-2 focus:ring-emerald-500">
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('modalIncome').close()"
                            class="flex-1 py-3.5 rounded-2xl border-2 border-slate-100 text-slate-500 font-bold hover:bg-slate-50 transition">Batal</button>
                        <button type="submit"
                            class="flex-1 py-3.5 rounded-2xl bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition transform hover:-translate-y-1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- MODAL 2: PAKAI UANG (EXPENSE) -->
    <dialog id="modalExpense"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/50 w-full max-w-sm open:animate-fade-in-up">
        <div class="bg-white p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-rose-50 rounded-bl-full -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-slate-900 mb-1">Pakai Uang</h3>
                <p class="text-slate-500 text-sm mb-6">Catat pengeluaran dari {{ $category->name }}</p>
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="expense">
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-xl font-bold text-rose-500">Rp</span>
                        <input type="number" name="amount" placeholder="0"
                            class="w-full pl-12 pr-4 py-4 text-3xl font-bold text-slate-800 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 placeholder:text-slate-300 text-center"
                            required>
                    </div>
                    <input type="text" name="description" placeholder="Untuk keperluan apa?"
                        class="w-full p-4 rounded-2xl bg-slate-50 border-none text-sm font-medium focus:ring-2 focus:ring-rose-500">
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('modalExpense').close()"
                            class="flex-1 py-3.5 rounded-2xl border-2 border-slate-100 text-slate-500 font-bold hover:bg-slate-50 transition">Batal</button>
                        <button type="submit"
                            class="flex-1 py-3.5 rounded-2xl bg-rose-600 text-white font-bold shadow-lg shadow-rose-200 hover:bg-rose-700 transition transform hover:-translate-y-1">Catat</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</x-app-layout>