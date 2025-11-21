<x-guest-layout>
    <div class="relative z-10">
        
        <!-- Header Icon & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-amber-50 text-amber-500 mb-6 shadow-inner border border-amber-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Lupa Password?</h2>
            <p class="text-sm text-slate-500 mt-2 px-2 leading-relaxed">
                Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.
            </p>
        </div>

        <!-- Session Status (Notifikasi Sukses) -->
        <x-auth-session-status class="mb-6 text-center font-bold text-emerald-600 bg-emerald-50 p-4 rounded-2xl border border-emerald-100" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Email
                </label>
                
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-amber-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-amber-500 focus:bg-white transition-all duration-300 shadow-inner" 
                           type="email" 
                           name="email" 
                           :value="old('email')" 
                           placeholder="nama@email.com"
                           required autofocus />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-amber-500 hover:shadow-amber-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2 group">
                    <span>Kirim Link Reset</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>

            <!-- Back to Login -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-slate-800 transition duration-300 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </form>
    </div>

    <!-- Background Decoration -->
    <div class="absolute top-[-80px] left-[-80px] w-48 h-48 bg-amber-200/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-50px] right-[-50px] w-40 h-40 bg-rose-200/20 rounded-full blur-3xl -z-10"></div>
</x-guest-layout>