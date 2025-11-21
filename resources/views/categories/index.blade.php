<x-app-layout>
    <!-- Alpine Data: Search & Pockets -->
    <div class="min-h-screen bg-slate-50 pb-20 font-sans relative overflow-x-hidden" x-data="{ 
            search: '',
            pockets: {{ $categories }}
         }">

        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-indigo-50/50 to-transparent -z-10 pointer-events-none">
        </div>
        <div class="absolute top-[-100px] right-[-100px] w-96 h-96 bg-purple-200/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-[200px] left-[-100px] w-80 h-80 bg-amber-100/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- HEADER & SEARCH BAR -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">
                        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-800">Semua Kantong</span>
                    </div>
                    <!-- PERUBAHAN DI SINI: Mengganti emoji 👛 dengan ikon Phosphor -->
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        Koleksi Kantong <i class="ph ph-shopping-bag"></i>
                    </h2>
                    <p class="text-slate-500 mt-1 font-medium">Kelola semua pos keuanganmu di sini.</p>
                </div>

                <!-- Kolom Pencarian Modern -->
                <div class="relative w-full md:w-96 group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl shadow-sm border border-slate-200 flex items-center overflow-hidden focus-within:border-indigo-500 focus-within:ring-4 focus-within:ring-indigo-500/10 transition-all">
                        <span class="pl-4 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" x-model="search" placeholder="Cari nama kantong..."
                            class="w-full pl-3 pr-4 py-3.5 border-none bg-transparent text-slate-800 placeholder-slate-400 font-bold focus:ring-0">
                    </div>
                </div>
            </div>

            <!-- GRID KANTONG -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- KARTU 1: TOMBOL BUAT BARU (Dotted Style) -->
                <button onclick="document.getElementById('categoryModal').showModal()"
                    class="group relative h-[240px] w-full bg-amber-50/50 rounded-[2.5rem] border-2 border-dashed border-amber-300 flex flex-col items-center justify-center gap-4 hover:bg-amber-100 hover:border-amber-400 hover:-translate-y-2 transition-all duration-300 cursor-pointer overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:8px_8px] opacity-20">
                    </div>

                    <div
                        class="w-16 h-16 bg-amber-400 text-white rounded-full flex items-center justify-center shadow-lg shadow-amber-400/40 group-hover:scale-110 transition-transform duration-300 group-hover:rotate-90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="font-bold text-amber-700 text-lg">Buat Kantong</span>
                </button>

                <!-- LOOPING KANTONG DENGAN FILTER (Dark Premium Style) -->
                <template x-for="cat in pockets.filter(p => p.name.toLowerCase().includes(search.toLowerCase()))"
                    :key="cat.id">
                    <a :href="'{{ url('/categories') }}/' + cat.id" class="relative group block h-full">
                        <div
                            class="h-[240px] bg-slate-900 rounded-[2.5rem] p-6 flex flex-col justify-between shadow-xl shadow-slate-900/10 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-800 relative">

                            <!-- Background Glow Dinamis -->
                            <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition duration-500"
                                :class="cat.type === 'income' ? 'bg-emerald-500' : 'bg-rose-500'"></div>

                            <!-- Header Kartu -->
                            <div class="flex justify-between items-start z-10">
                                <!-- Icon Kantong -->
                                <div
                                    class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl backdrop-blur-md bg-white/10 border border-white/10 shadow-inner text-white">
                                    <!-- Ganti Emoji dengan Icon Phosphor -->
                                    <i class="ph ph-cardholder" x-show="cat.type === 'income'"></i>
                                    <i class="ph ph-currency-circle-dollar" x-show="cat.type !== 'income'"></i>
                                </div>

                                <!-- Chip Arrow -->
                                <div
                                    class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-white/20 transition text-slate-400 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transform -rotate-45 group-hover:rotate-0 transition duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Info Kantong -->
                            <div class="z-10 mt-auto">
                                <h4 class="text-slate-300 text-xs font-bold uppercase tracking-widest mb-1 opacity-80"
                                    x-text="cat.type === 'income' ? 'Tabungan' : 'Pengeluaran'"></h4>
                                <h3 class="text-xl font-bold text-white tracking-tight mb-2 truncate" x-text="cat.name">
                                </h3>

                                <div class="h-px w-full bg-slate-800 mb-3"></div>

                                <div class="flex items-baseline gap-1">
                                    <span class="text-sm text-slate-400 font-medium">Rp</span>
                                    <span class="text-2xl font-extrabold text-white tracking-tight">
                                        <span x-text="new Intl.NumberFormat('id-ID').format(cat.balance)"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>
                </template>

                <!-- State Jika Pencarian Kosong -->
                <div x-show="pockets.length > 0 && pockets.filter(p => p.name.toLowerCase().includes(search.toLowerCase())).length === 0"
                    class="col-span-full py-20 text-center">
                    <div class="inline-block p-4 rounded-full bg-slate-100 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="text-slate-500 font-bold text-lg">Kantong tidak ditemukan.</p>
                    <p class="text-slate-400 text-sm">Coba kata kunci lain.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- INCLUDE MODAL BUAT KANTONG (PENTING: Agar tombol berfungsi) -->
    @include('components.modals.create-category')

</x-app-layout>