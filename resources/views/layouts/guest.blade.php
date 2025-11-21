<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dompet Rantau') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        
        <!-- Container Utama -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            
            <!-- Dekorasi Latar Belakang Global -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-indigo-100/50 to-transparent -z-20 pointer-events-none"></div>
            <div class="absolute top-[-100px] left-[-100px] w-96 h-96 bg-blue-200/20 rounded-full blur-3xl -z-10"></div>
            <div class="absolute bottom-[-100px] right-[-100px] w-96 h-96 bg-rose-200/20 rounded-full blur-3xl -z-10"></div>

            <!-- Logo Aplikasi (Opsional: Jika ingin logo kecil di atas kartu, uncomment ini) -->
            <!-- 
            <div class="mb-6">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-slate-800">Dompet Rantau</span>
                </a>
            </div> 
            -->

            <!-- Kartu Konten (Login/Register Form) -->
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl shadow-slate-200/50 border border-slate-100 rounded-[2.5rem] relative z-10">
                {{ $slot }}
            </div>

            <!-- Copyright Footer -->
            <div class="mt-8 text-center text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} Dompet Rantau. All rights reserved.
            </div>
        </div>
    </body>
</html>