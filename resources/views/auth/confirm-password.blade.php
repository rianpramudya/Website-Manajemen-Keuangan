<x-guest-layout>
    <div class="relative z-10">
        
        <!-- Header Icon & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-rose-50 text-rose-500 mb-6 shadow-inner border border-rose-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Konfirmasi Akses</h2>
            <p class="text-sm text-slate-500 mt-2 px-4 leading-relaxed">
                {{ __('Ini adalah area aman. Mohon masukkan password Anda untuk melanjutkan.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password Input Modern -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    {{ __('Password') }}
                </label>

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-rose-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <input id="password" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-rose-500 focus:bg-white transition-all duration-300 shadow-inner"
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required autocomplete="current-password" />
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Action Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-rose-600 hover:shadow-rose-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2 group">
                    <span>{{ __('Konfirmasi') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Background Decoration (Optional, if guest layout doesn't have it) -->
    <div class="absolute top-[-50px] left-[-50px] w-32 h-32 bg-rose-200/30 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-50px] right-[-50px] w-40 h-40 bg-blue-200/30 rounded-full blur-3xl -z-10"></div>
</x-guest-layout>