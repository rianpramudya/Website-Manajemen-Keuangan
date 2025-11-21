<x-app-layout>
    <!-- Alpine Logic: Mengatur Tab & Filter -->
    <div x-data="{ activeTab: 'active', filter: 'all' }"
        class="min-h-screen bg-slate-50 pb-20 font-sans relative overflow-x-hidden">

        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[400px] bg-gradient-to-b from-indigo-100/50 to-transparent -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- HEADER & SALDO -->
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        Manajemen Tagihan <i class="ph-fill ph-invoice"></i>
                    </h2>
                    <p class="text-slate-500 mt-2 font-medium">Atur pembayaran rutinmu agar tidak boncos.</p>
                </div>

                <!-- Kartu Saldo Mini -->
                <div
                    class="bg-white p-6 rounded-[2rem] shadow-lg shadow-slate-200/50 border border-slate-100 flex items-center gap-6 relative overflow-hidden group w-full md:w-auto">
                    <!-- Efek Dekorasi -->
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-[3rem] -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Saldo Bersih
                            Tersedia</p>
                        <h3 class="text-3xl font-extrabold text-slate-800">Rp {{ number_format($currentBalance, 0, ',',
                            '.') }}</h3>
                    </div>

                    <!-- Tombol Tambah Saldo -->
                    <button onclick="document.getElementById('addFundsModal').showModal()"
                        class="relative z-10 ml-auto bg-slate-900 text-white px-5 py-3 rounded-2xl text-sm font-bold hover:bg-blue-600 transition shadow-xl shadow-slate-900/20 flex items-center gap-2 transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Isi Saldo
                    </button>
                </div>
            </div>

            <!-- CONTROLS: TABS & FILTER -->
            <div
                class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 bg-white p-2 rounded-3xl shadow-sm border border-slate-100 sticky top-24 z-30">
                <!-- Tab Utama -->
                <div class="flex bg-slate-100 p-1 rounded-2xl">
                    <button @click="activeTab = 'active'"
                        :class="activeTab === 'active' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
                        Tagihan Aktif
                    </button>
                    <button @click="activeTab = 'history'"
                        :class="activeTab === 'history' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2">
                        Riwayat Lunas <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    </button>
                </div>

                <!-- Filter Kategori Waktu -->
                <div x-show="activeTab === 'active'"
                    class="flex gap-2 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0 px-2 no-scrollbar">
                    <button @click="filter = 'all'"
                        :class="filter === 'all' ? 'bg-slate-800 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">Semua</button>
                    <button @click="filter = 'monthly'"
                        :class="filter === 'monthly' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">Bulanan</button>
                    <button @click="filter = 'weekly'"
                        :class="filter === 'weekly' ? 'bg-purple-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">Mingguan</button>
                </div>

                <!-- Tombol Tambah Tagihan -->
                <button onclick="document.getElementById('createBillModal').showModal()"
                    class="ml-auto sm:ml-0 w-full sm:w-auto bg-indigo-50 text-indigo-600 border border-indigo-100 px-5 py-2.5 rounded-2xl text-sm font-bold hover:bg-indigo-100 transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Data Baru
                </button>
            </div>

            <!-- LIST TAGIHAN (CARDS) -->
            <div class="space-y-6">
                @php
                $unpaidBills = $bills->whereIn('status', ['unpaid', 'partial']);
                $paidBills = $bills->where('status', 'paid');
                @endphp

                <!-- STATE: KOSONG -->
                @if($bills->isEmpty())
                <div class="text-center py-20 bg-white rounded-[2.5rem] border-2 border-dashed border-slate-200/70">
                    <div
                        class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl shadow-sm">
                        <i class="ph-fill ph-invoice"></i></div>
                    <h3 class="text-xl font-bold text-slate-800">Belum Ada Data Tagihan</h3>
                    <p class="text-slate-400 mt-2">Tambahkan tagihan rutinmu agar tidak lupa bayar.</p>
                </div>
                @endif

                <!-- TAB: TAGIHAN AKTIF (Gaya Kartu Gelap / Dark Cards) -->
                <div x-show="activeTab === 'active'">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($unpaidBills as $bill)
                        <!-- Item -->
                        <div x-show="filter === 'all' || filter === '{{ $bill->frequency == 'monthly' ? 'monthly' : 'weekly' }}'"
                            class="relative group bg-slate-900 rounded-[2.5rem] p-6 flex flex-col justify-between shadow-xl shadow-slate-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-800 h-[240px]">

                            <!-- Background Glow (Dinamis berdasarkan status) -->
                            <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full blur-3xl opacity-20 transition duration-500
                                {{ $bill->status == 'partial' ? 'bg-amber-500' : 'bg-blue-500' }}"></div>

                            <!-- Header Kartu -->
                            <div class="relative z-10 flex justify-between items-start mb-4">
                                <div class="flex items-center gap-4">
                                    <!-- PERUBAHAN DI SINI: Mengganti emoji dengan ikon Phosphor -->
                                    <div
                                        class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl backdrop-blur-md bg-white/10 border border-white/10 shadow-inner text-white">
                                        <i class="ph-fill ph-money-wavy"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-white text-lg leading-tight">{{ $bill->name }}</h4>
                                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-1">
                                            Jatuh Tempo Tgl {{ $bill->due_date }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Menu Dropdown (Edit & Hapus) -->
                                <div class="relative" x-data="{ menuOpen: false }">
                                    <button @click="menuOpen = !menuOpen" @click.away="menuOpen = false"
                                        class="text-slate-500 hover:text-white transition p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                    <div x-show="menuOpen"
                                        class="absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl border border-slate-100 z-20 py-1 overflow-hidden"
                                        style="display: none;">
                                        <!-- Tombol Edit -->
                                        <button
                                            onclick="openEditModal({{ $bill->id }}, '{{ addslashes($bill->name) }}', {{ $bill->amount }}, {{ $bill->due_date ?? 'null' }}, '{{ $bill->frequency }}')"
                                            class="w-full text-left px-4 py-2.5 text-xs font-bold text-indigo-600 hover:bg-indigo-50 transition border-b border-slate-50">
                                            Ubah Data
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('bills.destroy', $bill) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button
                                                class="w-full text-left px-4 py-2.5 text-xs font-bold text-rose-500 hover:bg-rose-50 transition">Hapus
                                                Data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Pembayaran -->
                            <div class="relative z-10 mt-auto">
                                <div class="flex justify-between items-end mb-4">
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold mb-1">Sisa Pembayaran</p>
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-2xl font-bold text-white tracking-tight">Rp {{
                                                number_format($bill->remaining_amount, 0, ',', '.') }}</span>
                                        </div>
                                        <!-- Progress Bar Kecil -->
                                        <div class="w-full h-1.5 bg-slate-800 rounded-full mt-3 overflow-hidden">
                                            @php $percent = $bill->amount > 0 ? ($bill->paid_amount / $bill->amount) *
                                            100 : 0; @endphp
                                            <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full transition-all duration-500"
                                                style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="flex justify-between text-[10px] font-medium text-slate-500 mt-1.5">
                                            <span>Terbayar: {{ number_format($bill->paid_amount) }}</span>
                                            <span>Total: {{ number_format($bill->amount) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Bayar Individual -->
                                <button
                                    onclick="openPayModal({{ $bill->id }}, '{{ $bill->name }}', {{ $bill->remaining_amount }})"
                                    class="w-full py-3 rounded-xl font-bold text-sm shadow-lg transition-all transform active:scale-95 flex justify-center items-center gap-2
                                    {{ $bill->status == 'partial' ? 'bg-amber-500 hover:bg-amber-600 text-white shadow-amber-500/20' : 'bg-white hover:bg-slate-50 text-slate-900 shadow-white/10' }}">
                                    <span>{{ $bill->status == 'partial' ? 'Lanjutkan Bayar' : 'Bayar Tagihan' }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Empty State Filter -->
                    @if($unpaidBills->isEmpty() && !$bills->isEmpty())
                    <div
                        class="text-center py-16 bg-emerald-50/50 rounded-[2.5rem] border-2 border-dashed border-emerald-100">
                        <div
                            class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            <i class="ph-fill ph-megaphone"></i></div>
                        <h3 class="text-xl font-bold text-emerald-800">Luar Biasa!</h3>
                        <p class="text-emerald-600 text-sm">Semua tagihan bulan ini sudah lunas.</p>
                    </div>
                    @endif
                </div>

                <!-- TAB: RIWAYAT LUNAS -->
                <div x-show="activeTab === 'history'" style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($paidBills as $bill)
                        <div
                            class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex justify-between items-center opacity-80 hover:opacity-100 transition">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-600 line-through decoration-slate-300">{{
                                        $bill->name }}</h4>
                                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider mt-0.5">Lunas
                                        • Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full">Bulan
                                Ini</span>
                        </div>
                        @endforeach
                    </div>
                    @if($paidBills->isEmpty())
                    <div class="text-center py-12 text-slate-400 text-sm font-medium">Belum ada tagihan yang lunas bulan
                        ini.</div>
                    @endif
                </div>

                <!-- TABEL PEMBAYARAN INTERAKTIF -->
                @if($unpaidBills->isNotEmpty())
                <div x-data="billTable"
                    class="mt-16 bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900">Tabel Pembayaran Cepat <i class="ph-fill ph-lightning"></i> </h3>
                            <p class="text-slate-500 text-sm">Centang tagihan yang ingin dibayar menggunakan <b>Saldo
                                    Bersih</b>.</p>
                        </div>
                        <!-- Tanggal Bayar -->
                        <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-xl border border-slate-200">
                            <span class="text-xs font-bold text-slate-400 uppercase px-2">Tgl Bayar:</span>
                            <input type="date" x-model="paymentDate"
                                class="bg-white border-none rounded-lg text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <form action="{{ route('bills.bulkPay') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" x-bind:value="paymentDate">

                        <div class="overflow-x-auto">
                            <!-- PERBAIKAN: Tambahkan class 'table-fixed' agar lebar kolom dikunci -->
                            <table class="w-full text-left border-collapse table-fixed">
                                <thead>
                                    <tr class="border-b border-slate-100">
                                        <!-- Lebar kolom Checkbox: Fixed 3rem (w-12) -->
                                        <th
                                            class="p-4 text-xs font-extrabold text-slate-400 uppercase tracking-wider w-12">
                                            <input type="checkbox" @change="toggleAll($event)"
                                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 w-5 h-5">
                                        </th>

                                        <!-- Lebar kolom Nama: Auto/Flexible (bisa w-1/4 atau w-auto) -->
                                        <th
                                            class="p-4 text-xs font-extrabold text-slate-400 uppercase tracking-wider w-1/4">
                                            Nama Tagihan</th>

                                        <!-- Lebar kolom Input: Fixed 400px agar input tidak goyang -->
                                        <th
                                            class="p-4 text-xs font-extrabold text-slate-400 uppercase tracking-wider w-[400px]">
                                            Jumlah Bayar (Nominal / %)</th>

                                        <!-- Lebar kolom Sisa: Fixed/Proporsional -->
                                        <th
                                            class="p-4 text-xs font-extrabold text-slate-400 uppercase tracking-wider w-1/5">
                                            Sisa Tagihan</th>

                                        <!-- Lebar kolom Status: Fixed/Proporsional -->
                                        <th
                                            class="p-4 text-xs font-extrabold text-slate-400 uppercase tracking-wider w-32">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <template x-for="(row, index) in rows" :key="row.id">
                                        <tr :class="row.selected ? 'bg-indigo-50/50' : 'hover:bg-slate-50'"
                                            class="transition-colors">
                                            <!-- Checkbox Pilih -->
                                            <td class="p-4">
                                                <input type="checkbox" x-model="row.selected"
                                                    class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 w-5 h-5">

                                                <input type="hidden" :name="'payments[' + index + '][bill_id]'"
                                                    :value="row.id">
                                                <input type="hidden" :name="'payments[' + index + '][selected]'"
                                                    :value="row.selected ? 1 : 0">
                                            </td>

                                            <!-- Nama Tagihan -->
                                            <td class="p-4 truncate">
                                                <div class="font-bold text-slate-700" x-text="row.name"></div>
                                                <div class="text-xs text-slate-400">Total: Rp <span
                                                        x-text="formatNumber(row.original_total)"></span></div>
                                            </td>

                                            <!-- Input Jumlah Bayar (Flexibel: Rp & %) -->
                                            <td class="p-4">
                                                <div class="flex items-center gap-2 w-full">
                                                    <!-- Input Nominal (Rp) -->
                                                    <div class="relative flex-1">
                                                        <span
                                                            class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-bold">Rp</span>
                                                        <input type="number" :name="'payments[' + index + '][amount]'"
                                                            x-model.number="row.pay_amount"
                                                            @input="updatePercentFromAmount(row)"
                                                            :disabled="!row.selected"
                                                            class="w-full pl-8 pr-2 py-2 rounded-xl border border-slate-200 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400 transition"
                                                            placeholder="0">
                                                    </div>

                                                    <!-- Input Persentase (%) -->
                                                    <div class="relative w-24 shrink-0">
                                                        <input type="number" x-model.number="row.percent"
                                                            @input="updateAmountFromPercent(row)"
                                                            :disabled="!row.selected" min="0" max="100"
                                                            class="w-full pl-3 pr-6 py-2 rounded-xl border border-slate-200 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400 transition text-center"
                                                            placeholder="100">
                                                        <span
                                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-bold">%</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Sisa Tagihan (Otomatis) -->
                                            <td class="p-4">
                                                <div class="font-bold text-slate-700">
                                                    Rp <span x-text="formatNumber(calculateRemaining(row))"></span>
                                                </div>
                                            </td>

                                            <!-- Status (Otomatis) -->
                                            <td class="p-4">
                                                <span
                                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider whitespace-nowrap"
                                                    :class="getStatusClass(row)">
                                                    <span x-text="getStatusText(row)"></span>
                                                </span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer Form: Total & Submit -->
                        <div class="mt-6 flex justify-end items-center gap-6 pt-6 border-t border-slate-100">
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-400 uppercase">Total Pembayaran</p>
                                <p class="text-2xl font-extrabold text-indigo-600">Rp <span
                                        x-text="formatNumber(grandTotal)"></span></p>
                                <p class="text-[10px] text-slate-400 font-bold mt-1">*Menggunakan Saldo Bersih (Kantong
                                    Nabung)</p>
                            </div>
                            <button type="submit" :disabled="grandTotal <= 0"
                                class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                                <span>Bayar Sekarang</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Logic JS untuk Tabel -->
                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('billTable', () => ({
                            paymentDate: '{{ date("Y-m-d") }}',
                            rows: [
                                @foreach($unpaidBills as $bill)
                                {
                                    id: {{ $bill->id }},
                                    name: '{{ addslashes($bill->name) }}',
                                    original_total: {{ $bill->remaining_amount }},
                                    pay_amount: {{ $bill->remaining_amount }},
                                    percent: 100, // Default 100%
                                    selected: false
                                },
                                @endforeach
                            ],

                            toggleAll(event) {
                                this.rows.forEach(row => row.selected = event.target.checked);
                            },

                            // Update Nominal berdasarkan Persen
                            updateAmountFromPercent(row) {
                                let pct = parseFloat(row.percent);
                                if (isNaN(pct) || pct < 0) pct = 0;
                                // if (pct > 100) pct = 100; // Optional: batasi max 100%
                                
                                // Hitung nominal: (percent / 100) * original
                                row.pay_amount = Math.round((pct / 100) * row.original_total);
                            },

                            // Update Persen berdasarkan Nominal
                            updatePercentFromAmount(row) {
                                let amt = parseFloat(row.pay_amount);
                                if (isNaN(amt) || amt < 0) amt = 0;
                                
                                // Hitung persen: (nominal / original) * 100
                                if (row.original_total > 0) {
                                    let calculatedPercent = (amt / row.original_total) * 100;
                                    // Format biar rapi, max 1 desimal (misal 33.3)
                                    row.percent = parseFloat(calculatedPercent.toFixed(1)); 
                                } else {
                                    row.percent = 0;
                                }
                            },

                            calculateRemaining(row) {
                                let remaining = row.original_total - (row.pay_amount || 0);
                                return remaining < 0 ? 0 : remaining;
                            },

                            getStatusText(row) {
                                let remaining = this.calculateRemaining(row);
                                if (remaining <= 0) return 'Lunas';
                                if ((row.pay_amount > 0) && (remaining < row.original_total)) return 'Sebagian';
                                return 'Belum Lunas';
                            },

                            getStatusClass(row) {
                                let remaining = this.calculateRemaining(row);
                                if (remaining <= 0) return 'bg-emerald-100 text-emerald-600';
                                if ((row.pay_amount > 0) && (remaining < row.original_total)) return 'bg-amber-100 text-amber-600';
                                return 'bg-rose-100 text-rose-600';
                            },

                            get grandTotal() {
                                return this.rows
                                    .filter(row => row.selected)
                                    .reduce((sum, row) => sum + (parseInt(row.pay_amount) || 0), 0);
                            },

                            formatNumber(num) {
                                return new Intl.NumberFormat('id-ID').format(num);
                            }
                        }));
                    });
                </script>
                @endif

            </div>
        </div>
    </div>

    <!-- MODAL 1: Tambah Tagihan Baru (SAMA) -->
    <dialog id="createBillModal"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/40 w-full max-w-md open:animate-fade-in-up">
        <div class="bg-white p-8">
            <h3 class="text-2xl font-bold text-slate-900 mb-1">Tagihan Baru</h3>
            <p class="text-slate-500 text-sm mb-6">Tambahkan data tagihan rutinmu.</p>

            <form action="{{ route('bills.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Nama Tagihan</label>
                    <input type="text" name="name" placeholder="Contoh: Internet, Listrik"
                        class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 font-medium"
                        required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Jumlah Tagihan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-slate-400 font-bold">Rp</span>
                        <input type="number" name="amount" placeholder="0"
                            class="w-full pl-12 p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 font-bold text-lg"
                            required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Tgl Jatuh
                            Tempo</label>
                        <input type="number" name="due_date" placeholder="1-31" min="1" max="31"
                            class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Frekuensi</label>
                        <select name="frequency"
                            class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 font-medium appearance-none">
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                            <option value="one_time">Sekali</option>
                        </select>
                    </div>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('createBillModal').close()"
                        class="flex-1 py-3.5 rounded-2xl bg-slate-100 font-bold text-slate-500 hover:bg-slate-200 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- MODAL EDIT (SAMA) -->
    <dialog id="editBillModal"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/40 w-full max-w-md open:animate-fade-in-up">
        <div class="bg-white p-8">
            <h3 class="text-2xl font-bold text-slate-900 mb-1">Ubah Tagihan</h3>
            <p class="text-slate-500 text-sm mb-6">Perbarui informasi tagihan ini.</p>

            <form id="editBillForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Nama Tagihan</label>
                    <input type="text" id="editName" name="name"
                        class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium"
                        required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Jumlah Tagihan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-slate-400 font-bold">Rp</span>
                        <input type="number" id="editAmount" name="amount"
                            class="w-full pl-12 p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-bold text-lg"
                            required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Tgl Jatuh
                            Tempo</label>
                        <input type="number" id="editDueDate" name="due_date" min="1" max="31"
                            class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Frekuensi</label>
                        <select id="editFrequency" name="frequency"
                            class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium appearance-none">
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                            <option value="one_time">Sekali</option>
                        </select>
                    </div>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('editBillModal').close()"
                        class="flex-1 py-3.5 rounded-2xl bg-slate-100 font-bold text-slate-500 hover:bg-slate-200 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- MODAL 2: Isi Saldo (SAMA) -->
    <dialog id="addFundsModal"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/40 w-full max-w-sm open:animate-fade-in-up">
        <div class="bg-white p-8 text-center">
            <div
                class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">Isi Saldo</h3>
            <p class="text-sm text-slate-500 mb-6">Masukkan uang tunai/transfer ke dompet.</p>

            <form action="{{ route('bills.addFunds') }}" method="POST" class="space-y-5">
                @csrf
                <div class="relative">
                    <span class="absolute left-6 top-4 text-xl font-bold text-emerald-500">Rp</span>
                    <input type="number" name="amount" placeholder="0"
                        class="w-full pl-14 pr-6 py-4 text-3xl font-bold text-slate-800 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 placeholder:text-slate-300 text-center"
                        required>
                </div>
                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="document.getElementById('addFundsModal').close()"
                        class="flex-1 py-3.5 rounded-2xl border border-slate-200 text-slate-500 font-bold hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-600">Tambah</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- MODAL 3: Bayar Tagihan -->
    <dialog id="payBillModal"
        class="modal p-0 rounded-[2.5rem] shadow-2xl backdrop:bg-slate-900/50 w-full max-w-md open:animate-fade-in-up">
        <div class="bg-white p-8 relative overflow-hidden">
            <!-- Decor -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[4rem] -mr-6 -mt-6 opacity-60"></div>

            <div class="relative z-10 mb-6">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Bayar Tagihan</h3>
                        <p id="payBillName" class="text-sm font-bold text-rose-500">Nama Tagihan</p>
                    </div>
                </div>
                <p class="text-slate-400 text-sm">Pastikan saldo cukup sebelum membayar.</p>
            </div>

            <form id="payBillForm" method="POST" class="space-y-6 relative z-10">
                @csrf

                <div class="bg-slate-50 p-5 rounded-3xl border border-slate-100 text-center">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Nominal Pembayaran</label>
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-2xl font-bold text-slate-400">Rp</span>
                        <input type="number" name="amount" id="payAmount"
                            class="w-full bg-transparent border-none text-center text-4xl font-bold text-slate-800 focus:ring-0 p-0 placeholder:text-slate-300"
                            required>
                    </div>
                    <p
                        class="text-[10px] text-slate-400 mt-2 font-medium bg-white inline-block px-2 py-1 rounded-lg border border-slate-100">
                        💡 Tips: Ubah nominal jika ingin mencicil (Partial Payment)
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Tanggal Bayar</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}"
                            class="w-full p-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-medium focus:border-rose-500 focus:ring-2 focus:ring-rose-200">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1 pl-1">Sumber Dana</label>
                        <!-- Dropdown Filtered: HANYA KANTONG NABUNG -->
                        <select name="category_id"
                            class="w-full p-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-medium focus:border-rose-500 focus:ring-2 focus:ring-rose-200">
                            <option value="">-- Pilih Kantong Nabung --</option>
                            @foreach($fundingSources as $source)
                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-slate-400 mt-1 ml-1">*Hanya kantong 'Income' yg ditampilkan.</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('payBillModal').close()"
                        class="flex-1 py-3.5 rounded-2xl bg-white border-2 border-slate-100 font-bold text-slate-500 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-rose-600 text-white font-bold shadow-lg shadow-rose-200 hover:bg-rose-700 transition transform hover:-translate-y-1">Bayar
                        Sekarang</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openPayModal(id, name, amount) {
            document.getElementById('payBillName').innerText = name;
            document.getElementById('payAmount').value = amount;
            const form = document.getElementById('payBillForm');
            form.action = `/bills/${id}/pay`; 
            document.getElementById('payBillModal').showModal();
        }

        function openEditModal(id, name, amount, dueDate, frequency) {
            document.getElementById('editName').value = name;
            document.getElementById('editAmount').value = amount;
            document.getElementById('editDueDate').value = dueDate;
            document.getElementById('editFrequency').value = frequency;

            const form = document.getElementById('editBillForm');
            form.action = `/bills/${id}`; 
            
            document.getElementById('editBillModal').showModal();
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>