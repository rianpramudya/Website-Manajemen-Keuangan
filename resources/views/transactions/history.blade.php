<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8 font-sans relative overflow-x-hidden">

        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-indigo-50/50 to-transparent -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Navigation -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">
                        <a href="{{ route('dashboard') }}"
                            class="hover:text-indigo-600 transition flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-800">Riwayat Transaksi</span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Semua Aktivitas 📜</h2>
                </div>
            </div>

            <!-- GRID 2 KOLOM: PEMASUKAN & PENGELUARAN -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- KOLOM 1: PEMASUKAN (INCOME) -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-emerald-100 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[3rem] -mr-6 -mt-6 opacity-50">
                    </div>

                    <div class="relative z-10 flex justify-between items-center mb-6 pb-6 border-b border-slate-50">
                        <div>
                            <h3 class="font-bold text-slate-800 text-xl flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-sm">↓</span>
                                Pemasukan
                            </h3>
                            <p class="text-slate-400 text-sm mt-1">Total uang masuk tercatat</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Total</span>
                            <span class="block text-2xl font-extrabold text-emerald-600">
                                +Rp {{ number_format($totalIncome, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- List Pemasukan (Scrollable) -->
                    <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($incomeTransactions as $trx)
                        <div
                            class="flex items-center justify-between p-4 rounded-2xl bg-emerald-50/30 border border-emerald-100 hover:bg-emerald-50 transition group">
                            <div class="flex items-center gap-4 overflow-hidden">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-emerald-500 shadow-sm shrink-0">
                                    <i class="ph ph-cardholder text-lg"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">{{ $trx->category->name ?? 'Umum' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">{{ $trx->description ?: 'Tanpa catatan'
                                        }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 md:hidden">{{
                                        \Carbon\Carbon::parse($trx->date)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-bold text-emerald-600">+ {{ number_format($trx->amount, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-slate-400 hidden md:block">{{
                                    \Carbon\Carbon::parse($trx->date)->translatedFormat('d M Y') }}</p>

                                <!-- Tombol Hapus Kecil -->
                                <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                                    class="inline-block mt-1" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-[10px] text-rose-400 hover:text-rose-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-slate-400">
                            <p>Belum ada data pemasukan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- KOLOM 2: PENGELUARAN (EXPENSE) -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-rose-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[3rem] -mr-6 -mt-6 opacity-50">
                    </div>

                    <div class="relative z-10 flex justify-between items-center mb-6 pb-6 border-b border-slate-50">
                        <div>
                            <h3 class="font-bold text-slate-800 text-xl flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 text-sm">↑</span>
                                Pengeluaran
                            </h3>
                            <p class="text-slate-400 text-sm mt-1">Total uang keluar tercatat</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Total</span>
                            <span class="block text-2xl font-extrabold text-rose-600">
                                -Rp {{ number_format($totalExpense, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- List Pengeluaran (Scrollable) -->
                    <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($expenseTransactions as $trx)
                        <div
                            class="flex items-center justify-between p-4 rounded-2xl bg-rose-50/30 border border-rose-100 hover:bg-rose-50 transition group">
                            <div class="flex items-center gap-4 overflow-hidden">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-rose-500 shadow-sm shrink-0">
                                    <i class="ph ph-currency-circle-dollar text-lg"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">{{ $trx->category->name ?? 'Umum' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">{{ $trx->description ?: 'Tanpa catatan'
                                        }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 md:hidden">{{
                                        \Carbon\Carbon::parse($trx->date)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-bold text-rose-600">- {{ number_format($trx->amount, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-400 hidden md:block">{{
                                    \Carbon\Carbon::parse($trx->date)->translatedFormat('d M Y') }}</p>

                                <!-- Tombol Hapus Kecil -->
                                <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                                    class="inline-block mt-1" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-[10px] text-slate-400 hover:text-rose-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-slate-400">
                            <p>Belum ada data pengeluaran.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #e2e8f0;
            border-radius: 20px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #cbd5e1;
        }
    </style>
</x-app-layout>