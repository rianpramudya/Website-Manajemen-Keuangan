<x-guest-layout>
    <div class="relative z-10">
        
        <!-- Header Icon & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-indigo-50 text-indigo-600 mb-6 shadow-inner border border-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
            <p class="text-sm text-slate-500 mt-2 px-2">
                Masuk untuk mengelola keuangan rantau Anda.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6 text-center font-bold text-emerald-600 bg-emerald-50 p-4 rounded-2xl border border-emerald-100" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Email
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 shadow-inner" 
                           type="email" 
                           name="email" 
                           :value="old('email')" 
                           placeholder="nama@email.com"
                           required autofocus autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Password
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 shadow-inner"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="current-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" name="remember">
                    <span class="ml-2 text-sm text-slate-500 group-hover:text-slate-700 transition">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-indigo-500 hover:text-indigo-700 transition" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="pt-4">
                <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-indigo-600 hover:shadow-indigo-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2 group">
                    <span>{{ __('Masuk Akun') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-8 pt-6 border-t border-slate-100">
                <p class="text-sm text-slate-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800 hover:underline transition">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Background Decoration -->
    <div class="absolute top-[-60px] left-[-60px] w-40 h-40 bg-indigo-200/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-40px] right-[-40px] w-32 h-32 bg-purple-200/20 rounded-full blur-3xl -z-10"></div>
</x-guest-layout>