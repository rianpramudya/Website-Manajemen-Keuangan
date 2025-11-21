<x-app-layout>
    <!-- Style Scrollbar Kustom -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
    </style>

    <!-- Alpine Data -->
    <div x-data="{ showBalance: true, type: 'expense' }"
        class="min-h-screen bg-slate-50 pb-20 relative overflow-x-hidden">

        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-blue-50/50 to-transparent -z-10 pointer-events-none">
        </div>
        <div class="absolute top-[-100px] right-[-100px] w-96 h-96 bg-purple-200/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-[200px] left-[-100px] w-80 h-80 bg-amber-100/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- SECTION 1: HERO CARD -->
            <div
                class="relative bg-white rounded-[2.5rem] p-8 md:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden group transition-all duration-500 hover:shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)]">
                <div
                    class="absolute top-0 right-0 w-full h-full opacity-[0.03] bg-[radial-gradient(#4f46e5_1px,transparent_1px)] [background-size:16px_16px]">
                </div>
                <div
                    class="absolute -right-10 -top-10 w-64 h-64 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full blur-2xl opacity-60 group-hover:scale-110 transition-transform duration-700">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <!-- Kiri: Info Saldo -->
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-bold uppercase tracking-widest border border-slate-200">Total
                                Aset</span>
                            <button @click="showBalance = !showBalance"
                                class="p-1.5 rounded-full text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition duration-300"
                                title="Sembunyikan/Tampilkan">
                                <svg x-show="showBalance" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="!showBalance" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-baseline gap-2">
                            <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight font-[Inter]">
                                <span x-show="showBalance">Rp {{ number_format($balance, 0, ',', '.') }}</span>
                                <span x-show="!showBalance" class="tracking-widest text-slate-300">••••••••</span>
                            </h2>
                        </div>
                    </div>

                    <!-- Kanan: Action Buttons -->
                    <div class="flex gap-3 w-full md:w-auto">
                        <button onclick="document.getElementById('transferModal').showModal()"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-bold hover:border-blue-300 hover:text-blue-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            <span>Pindah Uang</span>
                        </button>
                        <a href="#create-transaction"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold shadow-xl shadow-slate-900/20 hover:bg-blue-600 hover:shadow-blue-600/30 hover:-translate-y-0.5 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Transaksi</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: KANTONG (POCKETS) -->
            <div class="mt-12 mb-6 flex justify-between items-end px-1">
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Kantong Saya <i class="ph-fill ph-bag-simple"></i> </h3>
                    <p class="text-sm text-slate-400 mt-1">Alokasi dana untuk berbagai kebutuhan.</p>
                </div>
                <a href="{{ route('categories.index') }}"
                    class="group flex items-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-700 transition">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Card 1: Tambah Kantong -->
                <button onclick="document.getElementById('categoryModal').showModal()"
                    class="group relative h-[180px] w-full bg-amber-50/50 rounded-[2rem] border-2 border-dashed border-amber-300 flex flex-col items-center justify-center gap-3 hover:bg-amber-100 hover:border-amber-400 hover:-translate-y-1 transition-all duration-300 cursor-pointer overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:8px_8px] opacity-20">
                    </div>
                    <div
                        class="w-14 h-14 bg-amber-400 text-white rounded-full flex items-center justify-center shadow-lg shadow-amber-400/40 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="font-bold text-amber-700">Buat Kantong Baru</span>
                </button>

                <!-- Card Loop: Kantong Data -->
                @foreach($displayPockets as $cat)
                <a href="{{ route('categories.show', $cat->id) }}" class="relative group h-[180px] w-full">
                    <div
                        class="absolute inset-0 bg-slate-900 rounded-[2rem] rotate-0 group-hover:rotate-2 transition-transform duration-300 opacity-50 scale-95 translate-y-2">
                    </div>
                    <div
                        class="relative h-full bg-slate-900 rounded-[2rem] p-6 flex flex-col justify-between shadow-xl shadow-slate-900/20 group-hover:-translate-y-2 transition-transform duration-300 overflow-hidden border border-slate-700/50">

                        <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition duration-500 
                            {{ $cat->type == 'income' ? 'bg-emerald-400' : 'bg-rose-400' }}"></div>

                        <div class="flex justify-between items-start z-10">
                            <div
                                class="w-10 h-10 rounded-2xl flex items-center justify-center text-white backdrop-blur-sm bg-white/10 border border-white/10">
                                <span class="text-lg">
                                    @if($cat->type == 'income')
                                    <i class="ph ph-cardholder"></i>
                                    @else
                                    <i class="ph ph-currency-circle-dollar"></i>
                                    @endif
                                </span>
                            </div>
                            <svg class="w-8 h-8 text-slate-600 opacity-50" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16v16H4z" fill="none" />
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h2v2H6zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"
                                    opacity=".3" />
                            </svg>
                        </div>

                        <div class="z-10">
                            <h4 class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">{{ $cat->name }}
                            </h4>
                            <div class="flex items-baseline gap-1">
                                <span class="text-2xl font-bold text-white tracking-tight">
                                    <span x-show="showBalance">Rp {{ number_format($cat->balance, 0, ',', '.') }}</span>
                                    <span x-show="!showBalance"
                                        class="text-slate-500 tracking-widest text-lg">••••••</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- SECTION 3: TRANSAKSI & RIWAYAT -->
            <div id="create-transaction" class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- Form Input (Kiri - Lebar) -->
                <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 h-full">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Catat Transaksi</h3>
                            <p class="text-sm text-slate-400">Jangan lupa catat setiap pengeluaranmu.</p>
                        </div>
                    </div>

                    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-2 gap-4 p-1.5 bg-slate-50 rounded-2xl border border-slate-200">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="expense" x-model="type" class="peer sr-only">
                                <div
                                    class="w-full py-3 text-center rounded-xl text-sm font-bold text-slate-500 transition-all duration-300 z-10 relative peer-checked:text-rose-600 hover:bg-white/50 flex items-center justify-center gap-2">
                                    Uang Keluar <i class="ph ph-currency-circle-dollar text-lg"></i>
                                </div>
                                <div
                                    class="absolute inset-0 bg-white rounded-xl shadow-sm border border-slate-200 scale-90 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300">
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="income" x-model="type" class="peer sr-only">
                                <div
                                    class="w-full py-3 text-center rounded-xl text-sm font-bold text-slate-500 transition-all duration-300 z-10 relative peer-checked:text-emerald-600 hover:bg-white/50 flex items-center justify-center gap-2">
                                    Isi Kantong <i class="ph ph-cardholder text-lg"></i>
                                </div>
                                <div
                                    class="absolute inset-0 bg-white rounded-xl shadow-sm border border-slate-200 scale-90 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300">
                                </div>
                            </label>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 pl-1">Nominal</label>
                            <div class="relative group">
                                <span class="absolute left-5 top-4 text-xl font-bold transition-colors duration-300"
                                    :class="type == 'expense' ? 'text-rose-300 group-focus-within:text-rose-500' : 'text-emerald-300 group-focus-within:text-emerald-500'">Rp</span>
                                <input type="number" name="amount" placeholder="0" required
                                    class="w-full pl-14 pr-6 py-4 text-2xl font-bold text-slate-800 bg-slate-50 border-none rounded-2xl focus:ring-2 transition-all duration-300 placeholder:text-slate-300"
                                    :class="type == 'expense' ? 'focus:ring-rose-200 focus:bg-rose-50/30' : 'focus:ring-emerald-200 focus:bg-emerald-50/30'">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase mb-2 pl-1">Pilih
                                    Kantong</label>
                                <div class="relative">
                                    <select name="category_id" required
                                        class="w-full p-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-medium focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition appearance-none cursor-pointer hover:border-blue-300">
                                        <option value="">-- Pilih --</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 top-4 pointer-events-none text-slate-400">▼</div>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase mb-2 pl-1">Tanggal</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                    class="w-full p-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-medium focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 pl-1">Catatan
                                (Opsional)</label>
                            <input type="text" name="description" placeholder="Contoh: Nasi Padang Lauk Rendang..."
                                class="w-full p-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-medium focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        </div>

                        <button type="submit"
                            class="w-full py-4 rounded-2xl text-white font-bold text-lg shadow-lg transition-all duration-300 hover:-translate-y-1 active:scale-95"
                            :class="type == 'expense' ? 'bg-rose-600 hover:bg-rose-700 shadow-rose-200' : 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-200'">
                            Simpan Transaksi
                        </button>
                    </form>
                </div>

                <!-- Riwayat / Feed (Kanan - Sejajar & Scrollable) -->
                <div
                    class="lg:col-span-1 bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 h-[720px] flex flex-col">
                    <div class="flex justify-between items-center mb-6 shrink-0">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Riwayat Terkini</h3>
                            <p class="text-slate-400 text-xs mt-0.5">Pantau aktivitasmu</p>
                        </div>

                        <!-- Tombol LIHAT SEMUA -->
                        <a href="{{ route('transactions.history') }}"
                            class="text-xs font-bold bg-slate-100 text-blue-600 px-3 py-1.5 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition">
                            Lihat Semua
                        </a>
                    </div>

                    <!-- Container List dengan Scroll -->
                    <div class="space-y-4 relative flex-grow overflow-y-auto pr-2 custom-scrollbar">
                        <div class="absolute left-[19px] top-2 bottom-2 w-0.5 bg-slate-100 -z-10"></div>

                        @forelse($transactions as $trx)
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 transition group bg-white border border-transparent hover:border-slate-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-colors z-10 shadow-sm shrink-0
                                    {{ $trx->type == 'income' ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : 'bg-rose-50 border-rose-100 text-rose-600' }}">
                                    @if($trx->type == 'income')
                                    <i class="ph ph-cardholder"></i>
                                    @else
                                    <i class="ph ph-currency-circle-dollar"></i>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ $trx->category->name ??
                                        'Umum' }}</p>
                                    <p class="text-xs text-slate-400 truncate w-24">{{ $trx->description ?: 'Tanpa
                                        catatan' }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p
                                    class="text-sm font-bold {{ $trx->type == 'income' ? 'text-emerald-600' : 'text-slate-900' }}">
                                    {{ $trx->type == 'income' ? '+' : '-' }} {{ number_format($trx->amount, 0, ',', '.')
                                    }}
                                </p>
                                <p
                                    class="text-[10px] text-slate-400 font-medium bg-slate-50 px-1.5 py-0.5 rounded inline-block mt-0.5">
                                    {{ \Carbon\Carbon::parse($trx->date)->format('d M') }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10 mt-12">
                            <div
                                class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl">
                                <i class="ph-fill ph-cash-register"></i></div>
                            <p class="text-slate-400 text-sm font-medium">Belum ada transaksi.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PENTING: Sertakan Komponen Modal di Sini -->
    @include('components.modals.create-category')

    <!-- Modal Transfer -->
    <dialog id="transferModal"
        class="modal p-0 rounded-[2rem] shadow-2xl backdrop:bg-slate-900/40 w-full max-w-md open:animate-fade-in-up">
        <div class="bg-white p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 opacity-50"></div>

            <div class="relative z-10 text-center mb-8">
                <div
                    class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Pindahkan Uang</h3>
                <p class="text-slate-500 text-sm">Geser saldo antar kantong dengan mudah.</p>
            </div>

            <form action="{{ route('transactions.transfer') }}" method="POST" class="space-y-5 relative z-10">
                @csrf
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1 text-center">Nominal
                        Pindah</label>
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-xl font-bold text-slate-400">Rp</span>
                        <input type="number" name="amount"
                            class="w-48 bg-transparent border-none text-center text-3xl font-bold text-slate-800 focus:ring-0 p-0 placeholder:text-slate-300"
                            placeholder="0" required>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="relative">
                        <select name="from_category_id"
                            class="w-full p-4 pl-12 rounded-xl bg-white border border-slate-200 font-medium text-slate-700 appearance-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
                            required>
                            <option value="">Sumber Dana</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }} (Sisa: {{ number_format($cat->balance) }})
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute left-4 top-4 text-rose-500">
                            <i class="ph ph-currency-circle-dollar text-xl"></i>
                        </div>
                    </div>

                    <div class="flex justify-center -my-4 z-20 relative">
                        <div class="bg-white p-1.5 rounded-full border border-slate-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select name="to_category_id"
                            class="w-full p-4 pl-12 rounded-xl bg-white border border-slate-200 font-medium text-slate-700 appearance-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
                            required>
                            <option value="">Tujuan Transfer</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute left-4 top-4 text-emerald-500">
                            <i class="ph ph-cardholder text-xl"></i>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('transferModal').close()"
                        class="flex-1 py-3.5 rounded-xl bg-slate-100 font-bold text-slate-500 hover:bg-slate-200 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1">Konfirmasi</button>
                </div>
            </form>
        </div>
    </dialog>

</x-app-layout>