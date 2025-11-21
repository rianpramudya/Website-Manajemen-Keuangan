<x-app-layout>
    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="min-h-screen bg-slate-50 pb-20 font-sans relative overflow-x-hidden">
        
        <!-- Dekorasi Latar Belakang -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-indigo-50/50 to-transparent -z-10 pointer-events-none"></div>
        <div class="absolute top-[-100px] right-[-100px] w-96 h-96 bg-purple-200/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-[200px] left-[-100px] w-80 h-80 bg-amber-100/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- HEADER & FILTER -->
            <div class="mb-10 flex flex-col lg:flex-row justify-between items-end gap-6">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Laporan Keuangan <i class="ph-fill ph-scroll"></i> </h2>
                    <p class="text-slate-500 mt-2 font-medium">Analisis arus kas periode <span class="text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded-lg">{{ $periodLabel }}</span>.</p>
                </div>
                
                <!-- Form Filter & Export -->
                <div class="flex flex-col sm:flex-row gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                    <form action="{{ route('reports.index') }}" method="GET" class="flex items-center gap-2">
                        <div class="relative">
                            <input type="date" name="start_date" value="{{ $startDate }}" class="pl-3 pr-2 py-2 rounded-xl border-slate-200 text-slate-600 text-xs font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <span class="text-slate-300 font-bold">-</span>
                        <div class="relative">
                            <input type="date" name="end_date" value="{{ $endDate }}" class="pl-3 pr-2 py-2 rounded-xl border-slate-200 text-slate-600 text-xs font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2.5 rounded-xl transition shadow-md shadow-indigo-200" title="Terapkan Filter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>

                    <div class="w-px h-8 bg-slate-100 hidden sm:block my-auto"></div>

                    <!-- Tombol Download AKTIF dengan Parameter Tanggal -->
                    <a href="{{ route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="bg-white border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-xs font-bold hover:bg-slate-50 transition shadow-sm flex items-center justify-center gap-2 hover:text-rose-600 hover:border-rose-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        PDF
                    </a>
                </div>
            </div>

            <!-- 1. RINGKASAN EKSEKUTIF (CARDS) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Card Pemasukan -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[3rem] -mr-6 -mt-6 transition-transform group-hover:scale-110"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Pemasukan</span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-emerald-600 truncate">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Total uang masuk periode ini</p>
                    </div>
                </div>

                <!-- Card Pengeluaran -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[3rem] -mr-6 -mt-6 transition-transform group-hover:scale-110"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-2xl bg-rose-100 flex items-center justify-center text-rose-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Pengeluaran</span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-rose-600 truncate">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Total uang keluar periode ini</p>
                    </div>
                </div>

                <!-- Card Arus Kas (Dark Theme) -->
                <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-xl shadow-slate-900/20 relative overflow-hidden group text-white">
                    <!-- Glow Effect -->
                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full blur-3xl opacity-20 transition duration-500 
                        {{ $cashflow >= 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white border border-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Arus Kas Bersih</span>
                        </div>
                        
                        <h3 class="text-3xl font-extrabold {{ $cashflow >= 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                            {{ $cashflow >= 0 ? '+' : '' }} Rp {{ number_format($cashflow, 0, ',', '.') }}
                        </h3>
                        
                        <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-white/10 border border-white/5 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full {{ $cashflow >= 0 ? 'bg-emerald-400' : 'bg-rose-400' }} animate-pulse"></span>
                            {{ $cashflow >= 0 ? 'Keuangan Sehat' : 'Defisit! Hemat Dulu' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. DETAIL ANALYSIS -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- GRAFIK PENGELUARAN -->
                <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 h-full">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-slate-800">Komposisi Pengeluaran</h4>
                        <!-- Info Tanggal -->
                        <span class="text-xs font-bold bg-slate-100 text-slate-500 px-2 py-1 rounded-lg">{{ $periodLabel }}</span>
                    </div>
                    
                    @if(count($chartData) > 0)
                        <div class="relative h-64 w-full">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    @else
                        <div class="h-64 w-full flex flex-col items-center justify-center text-slate-400 bg-slate-50/50 rounded-3xl border-2 border-dashed border-slate-200">
                            <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center mb-3 text-xl"> <i class="ph-fill ph-not-equals"></i> </div>
                            <p class="text-sm font-bold">Belum ada data pengeluaran periode ini.</p>
                        </div>
                    @endif
                </div>

                <!-- STATISTIK TAGIHAN & DISPOSABLE INCOME -->
                <div class="lg:col-span-1 flex flex-col gap-6">
                    
                    <!-- Card 1: Beban Tagihan -->
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden">
                         <h4 class="text-lg font-bold text-slate-800 mb-1">Beban Tagihan Rutin</h4>
                         <p class="text-xs text-slate-500 mb-6">Estimasi kewajiban bulanan (Master Data).</p>
                         
                         <div class="flex justify-between items-end mb-2">
                            <span class="text-sm font-bold text-slate-400">Total Wajib</span>
                            <span class="text-xl font-extrabold text-slate-800">Rp {{ number_format($totalEstimatedBills, 0, ',', '.') }}</span>
                         </div>
                         
                         <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            @php 
                                $billPercentage = $totalIncome > 0 ? ($totalEstimatedBills / $totalIncome) * 100 : 0;
                                $billColor = $billPercentage > 50 ? 'bg-rose-500' : 'bg-indigo-500';
                            @endphp
                            <div class="{{ $billColor }} h-full rounded-full transition-all duration-1000" style="width: {{ min($billPercentage, 100) }}%"></div>
                         </div>
                         <p class="text-[10px] text-slate-400 mt-2 font-medium">
                             Tagihan memakan <span class="{{ $billPercentage > 50 ? 'text-rose-500' : 'text-indigo-500' }} font-bold">{{ number_format($billPercentage, 1) }}%</span> dari pemasukanmu periode ini.
                         </p>
                    </div>

                    <!-- Card 2: Uang Bebas (Disposable) -->
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-8 rounded-[2.5rem] border border-emerald-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/40 rounded-bl-[4rem]"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-sm"><i class="ph-fill ph-currency-circle-dollar"></i></span>
                                <p class="text-xs font-bold text-emerald-700 uppercase tracking-widest">Uang Bebas</p>
                            </div>
                            
                            <h3 class="text-3xl font-extrabold text-emerald-800">
                                Rp {{ number_format($disposableIncome, 0, ',', '.') }}
                            </h3>
                            
                            <p class="text-xs text-emerald-600 mt-3 font-medium leading-relaxed">
                                Ini adalah "uang dingin" setelah dikurangi estimasi tagihan (berdasarkan pemasukan periode ini).
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- DATA HOLDER (JSON SAFE) -->
    <script id="chart-labels" type="application/json">{!! json_encode($chartLabels) !!}</script>
    <script id="chart-data" type="application/json">{!! json_encode($chartData) !!}</script>

    <!-- SCRIPT CHART.JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('expenseChart');
            
            if(ctx) {
                // Ambil data dari tag script JSON agar aman dari syntax error
                const labels = JSON.parse(document.getElementById('chart-labels').textContent);
                const data = JSON.parse(document.getElementById('chart-data').textContent);

                new Chart(ctx, {
                    type: 'doughnut', 
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pengeluaran (Rp)',
                            data: data,
                            backgroundColor: [
                                '#6366f1', // Indigo 500
                                '#ec4899', // Pink 500
                                '#f59e0b', // Amber 500
                                '#10b981', // Emerald 500
                                '#8b5cf6', // Violet 500
                                '#64748b', // Slate 500
                            ],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    boxWidth: 8,
                                    padding: 20,
                                    font: {
                                        family: "'Plus Jakarta Sans', sans-serif",
                                        size: 12,
                                        weight: 'bold'
                                    },
                                    color: '#64748b'
                                }
                            }
                        },
                        layout: {
                            padding: 10
                        },
                        cutout: '75%', // Donat lebih tipis modern
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>