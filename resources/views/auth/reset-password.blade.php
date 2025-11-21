<x-guest-layout>
    <div class="relative z-10">
        
        <!-- Header Icon & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-cyan-50 text-cyan-600 mb-6 shadow-inner border border-cyan-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Reset Password</h2>
            <p class="text-sm text-slate-500 mt-2 px-2">
                Buat password baru untuk mengamankan akun Anda.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Email
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-cyan-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-cyan-500 focus:bg-white transition-all duration-300 shadow-inner" 
                           type="email" 
                           name="email" 
                           :value="old('email', $request->email)" 
                           required autofocus autocomplete="username" 
                           readonly /> <!-- Biasanya email di-lock saat reset -->
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Password Baru
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-cyan-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-cyan-500 focus:bg-white transition-all duration-300 shadow-inner"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">
                    Konfirmasi Password Baru
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-focus-within:text-cyan-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input id="password_confirmation" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold placeholder-slate-300 focus:ring-2 focus:ring-cyan-500 focus:bg-white transition-all duration-300 shadow-inner"
                            type="password"
                            name="password_confirmation"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-center font-bold text-rose-500" />
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-cyan-600 hover:shadow-cyan-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2 group">
                    <span>{{ __('Reset Password') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Background Decoration -->
    <div class="absolute top-[-60px] left-[-60px] w-40 h-40 bg-cyan-200/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-40px] right-[-40px] w-32 h-32 bg-indigo-200/20 rounded-full blur-3xl -z-10"></div>
</x-guest-layout>