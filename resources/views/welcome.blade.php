<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dompet Rantau - Finansial Anak Kos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap"
        rel="stylesheet" />

    <!-- Phosphor Icons: DITAMBAHKAN DI SINI -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .text-gradient {
            background: linear-gradient(to right, #e11d48, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body
    class="antialiased bg-slate-50 text-slate-900 flex flex-col min-h-screen selection:bg-rose-500 selection:text-white">

    <!-- === NAVIGATION BAR === -->
    <nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="{'bg-white/80 backdrop-blur-lg shadow-lg shadow-slate-200/20 border-b border-white/20': scrolled, 'bg-transparent border-b border-transparent': !scrolled}"
        class="fixed w-full top-0 z-50 transition-all duration-500 ease-in-out">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">

                <!-- Logo Area -->
                <div class="flex items-center gap-10">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-rose-500 to-amber-500 rounded-2xl blur-lg opacity-40 group-hover:opacity-70 transition duration-500">
                            </div>
                            <div
                                class="relative w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-2xl border border-white/10 group-hover:scale-105 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="font-extrabold text-xl leading-none tracking-tight text-slate-900 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-slate-900 group-hover:to-slate-600 transition duration-300">Dompet</span>
                            <span
                                class="text-[10px] font-bold text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-amber-500 leading-none tracking-[0.2em] uppercase mt-1">Rantau</span>
                        </div>
                    </a>
                </div>

                <!-- Right Area (Auth Buttons) -->
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 rounded-full bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 hover:shadow-lg hover:shadow-slate-500/30 transition transform hover:-translate-y-0.5">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="hidden sm:block px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="group relative px-6 py-3 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-900 shadow-sm overflow-hidden transition-all duration-300 hover:border-rose-200 hover:shadow-rose-200/50 hover:shadow-lg">
                        <div
                            class="absolute inset-0 w-0 bg-gradient-to-r from-rose-500 to-amber-500 transition-all duration-[250ms] ease-out group-hover:w-full opacity-10">
                        </div>
                        <span class="relative flex items-center gap-2 group-hover:text-white transition-colors">
                            Buat Akun
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-rose-500 group-hover:text-white transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </a>
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- === HERO SECTION === -->
    <header class="relative pt-32 pb-20 overflow-hidden">
        <div
            class="absolute top-[-100px] left-[-100px] w-96 h-96 bg-blue-200/30 rounded-full blur-3xl -z-10 animate-pulse">
        </div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-amber-100/40 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-100 shadow-sm text-xs font-bold text-slate-500 mb-8 animate-bounce-slow">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                Solusi Keuangan Mahasiswa & Perantau
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-tight mb-6 text-slate-900">
                Atur Cuan Biar <br>
                <span class="text-gradient">Nggak Makan Mie Terus</span>
            </h1>

            <p class="text-lg text-slate-500 max-w-2xl mx-auto mb-10 leading-relaxed">
                Aplikasi pencatat keuangan simpel dengan fitur <strong>Kantong</strong> dan <strong>Manajemen
                    Tagihan</strong>. Pisahkan uang makan, laundry, dan tabungan agar akhir bulan tetap aman.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-20">
                @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-8 py-4 text-base font-bold text-white bg-slate-900 rounded-2xl hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-900/20 transition transform hover:-translate-y-1">
                    Buka Dompet Saya
                </a>
                @else
                <a href="{{ route('register') }}"
                    class="px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-rose-600 to-amber-500 rounded-2xl hover:shadow-xl hover:shadow-rose-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    Mulai Sekarang — Gratis
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </a>
                <!-- Tombol Pelajari Dulu yang Scroll ke Bawah -->
                <a href="#fitur"
                    class="px-8 py-4 text-base font-bold text-slate-600 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 hover:border-slate-300 transition scroll-smooth">
                    Pelajari Dulu
                </a>
                @endauth
            </div>

            <!-- Mockup Decoration -->
            <div class="relative mx-auto w-full max-w-4xl group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-rose-500 via-amber-500 to-indigo-500 rounded-[2rem] opacity-20 blur-xl group-hover:opacity-40 transition duration-1000">
                </div>
                <div class="relative bg-white border border-slate-100 rounded-[2rem] p-4 shadow-2xl overflow-hidden">
                    <div
                        class="bg-slate-50 rounded-3xl overflow-hidden aspect-[16/9] flex items-center justify-center border border-slate-100 relative">
                        <!-- Mockup Content -->
                        <div class="text-center z-10">
                            <div class="text-6xl mb-4 animate-bounce"> <i class="ph-fill ph-chart-bar"></i> </div>
                            <p class="text-slate-800 font-bold text-xl mb-2">Dashboard Keuangan Terpusat</p>
                            <p class="text-slate-500 text-sm">Pantau saldo, tagihan, dan laporan dalam satu layar.</p>
                        </div>
                        <!-- Decorative Blobs inside mockup -->
                        <div
                            class="absolute top-[-50%] left-[-20%] w-full h-full bg-gradient-to-br from-rose-100/50 to-transparent rounded-full blur-3xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- === FITUR SECTION (Tempat Scroll 'Pelajari Dulu') === -->
    <section id="fitur" class="py-24 bg-white relative scroll-mt-20">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Kenapa Harus Dompet Rantau?</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Kami paham masalah anak kos: uang kiriman habis di
                    tengah bulan karena lupa bayar tagihan atau jajan sembarangan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fitur 1: Kantong -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] hover:bg-slate-100 transition duration-300 group border border-slate-100 hover:border-slate-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ph ph-shopping-bag"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Sistem Kantong</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Pisahkan uangmu ke berbagai pos pengeluaran. Buat kantong untuk <strong>Makan</strong>,
                        <strong>Laundry</strong>, atau <strong>Tabungan</strong> agar tidak tercampur.
                    </p>
                </div>

                <!-- Fitur 2: Tagihan -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] hover:bg-slate-100 transition duration-300 group border border-slate-100 hover:border-slate-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ph-fill ph-invoice"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Manajemen Tagihan</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Catat kewajiban rutin seperti <strong>Kos</strong>, <strong>Listrik</strong>, atau
                        <strong>Internet</strong>. Sistem akan menghitung sisa uang "aman" yang boleh kamu pakai.
                    </p>
                </div>

                <!-- Fitur 3: Laporan -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] hover:bg-slate-100 transition duration-300 group border border-slate-100 hover:border-slate-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ph-fill ph-trend-up"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Laporan Visual</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Lihat kemana saja uangmu pergi dengan grafik yang mudah dipahami. Evaluasi pengeluaranmu setiap
                        bulan agar makin hemat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- === CALL TO ACTION === -->
    <section class="py-20 bg-slate-900 relative overflow-hidden">
        <!-- Abstract shapes -->
        <div
            class="absolute top-0 left-0 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20">
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-rose-500 rounded-full blur-3xl opacity-20"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500 rounded-full blur-3xl opacity-20"></div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                Siap Mengatur Keuanganmu?
            </h2>
            <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">
                Jangan tunggu sampai akhir bulan baru sadar uang habis. Mulai catat dan atur keuanganmu hari ini juga,
                gratis!
            </p>

            <a href="{{ route('register') }}"
                class="inline-flex items-center gap-3 px-10 py-4 bg-white text-slate-900 rounded-full font-bold text-lg hover:bg-slate-200 transition transform hover:-translate-y-1 shadow-2xl shadow-white/10">
                Buat Akun Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- === FOOTER === -->
    <footer class="bg-white border-t border-slate-100 relative overflow-hidden">
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[100px] bg-gradient-to-t from-slate-50 to-transparent -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                        <div
                            class="w-6 h-6 bg-slate-900 rounded-lg flex items-center justify-center text-white shadow-md">
                            <span class="font-bold text-xs">D</span>
                        </div>
                        <span class="font-bold text-slate-800">Dompet Rantau</span>
                    </div>
                    <p class="text-slate-400 text-sm font-medium">
                        Dibuat dengan <span class="text-rose-500 animate-pulse"><i class="ph-fill ph-heart"></i></span> & <i class="ph-fill ph-coffee"></i> untuk pejuang rantau.
                    </p>
                    <p class="text-slate-300 text-xs mt-1">&copy; {{ date('Y') }} All rights reserved.</p>
                </div>
                <div class="flex gap-6">
                    <a href="#"
                        class="text-slate-400 hover:text-slate-900 text-sm font-bold transition duration-300">Privacy
                        Policy</a>
                    <a href="#"
                        class="text-slate-400 hover:text-slate-900 text-sm font-bold transition duration-300">Terms of
                        Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>