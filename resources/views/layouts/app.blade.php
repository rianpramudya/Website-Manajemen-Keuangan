<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dompet Rantau') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap"
        rel="stylesheet" />

    <!-- Phosphor Icons (Tambahkan ini agar logo muncul) -->
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

        /* Animasi Gradient Text */
        .gradient-text {
            background: linear-gradient(to right, #e11d48, #ea580c, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body
    class="font-sans antialiased text-slate-900 bg-slate-50 flex flex-col min-h-screen selection:bg-rose-500 selection:text-white">

    <!-- === NAVIGATION BAR (FUTURISTIK) === -->
    <nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="{'bg-white/80 backdrop-blur-lg shadow-lg shadow-slate-200/20 border-b border-white/20': scrolled, 'bg-transparent border-b border-transparent': !scrolled}"
        class="fixed w-full top-0 z-50 transition-all duration-500 ease-in-out">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">

                <!-- Logo Area -->
                <div class="flex items-center gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <!-- Animated Glow -->
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

                    <!-- Desktop Menu -->
                    <div
                        class="hidden md:flex items-center bg-white/50 backdrop-blur-md px-2 py-1.5 rounded-full border border-white/50 shadow-sm">
                        @php
                        $navClasses = "px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 relative
                        overflow-hidden group";
                        $activeClasses = "text-white bg-slate-900 shadow-md";
                        $inactiveClasses = "text-slate-500 hover:text-slate-900 hover:bg-white/80";
                        @endphp

                        <a href="{{ route('dashboard') }}"
                            class="{{ $navClasses }} {{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
                            Dashboard
                        </a>
                        <a href="{{ route('bills.index') }}"
                            class="{{ $navClasses }} {{ request()->routeIs('bills.index') ? $activeClasses : $inactiveClasses }}">
                            Tagihan
                        </a>
                        <a href="{{ route('reports.index') }}"
                            class="{{ $navClasses }} {{ request()->routeIs('reports.index') ? $activeClasses : $inactiveClasses }}">
                            Laporan
                        </a>
                    </div>
                </div>

                <!-- Right Area (User) -->
                <div class="hidden sm:flex sm:items-center gap-4">
                    <!-- User Info Pill -->
                    <div
                        class="flex items-center gap-3 pl-4 pr-2 py-2 bg-white rounded-full border border-slate-100 shadow-sm hover:shadow-md transition duration-300 cursor-default">
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Halo,</p>
                            <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="h-8 w-px bg-slate-100 mx-1"></div>

                        <!-- Dropdown Trigger -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-900 hover:text-white transition duration-300 group relative">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 transform group-hover:rotate-90 transition duration-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs text-slate-400">Signed in as</p>
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <x-dropdown-link :href="route('profile.edit')" class="hover:bg-slate-50">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        Profile
                                    </span>
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-rose-500 hover:bg-rose-50 hover:text-rose-600">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Log Out
                                        </span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Hamburger (Mobile) -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-3 rounded-2xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-none transition duration-300">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Slide Down) -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="sm:hidden bg-white/90 backdrop-blur-xl border-b border-slate-100 shadow-xl absolute w-full z-40">

            <div class="pt-4 pb-6 space-y-2 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="rounded-xl">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bills.index')" :active="request()->routeIs('bills.index')"
                    class="rounded-xl">
                    {{ __('Hitung Tagihan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')"
                    class="rounded-xl">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-6 border-t border-slate-100 bg-slate-50/50 px-4">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-base text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-rose-600 rounded-xl">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- === CONTENT === -->
    <main class="flex-grow pt-24">
        <!-- Tambahan padding-top karena header fixed -->
        {{ $slot }}
    </main>

    <!-- === FOOTER FUTURISTIK === -->
    <footer class="bg-white border-t border-slate-100 mt-auto relative overflow-hidden">
        <!-- Decorative Glow -->
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[100px] bg-gradient-to-t from-slate-50 to-transparent -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">

                <!-- Brand & Copy -->
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
                    <p class="text-slate-300 text-xs mt-1">
                        &copy; {{ date('Y') }} All rights reserved.
                    </p>
                </div>

                <!-- Links -->
                <div class="flex gap-6">
                    <a href="#"
                        class="text-slate-400 hover:text-slate-900 text-sm font-bold transition duration-300">Privacy
                        Policy</a>
                    <a href="#"
                        class="text-slate-400 hover:text-slate-900 text-sm font-bold transition duration-300">Terms of
                        Service</a>
                    <a href="#"
                        class="text-slate-400 hover:text-slate-900 text-sm font-bold transition duration-300">Support</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>