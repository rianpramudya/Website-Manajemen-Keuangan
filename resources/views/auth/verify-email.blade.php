<x-guest-layout>
    <div class="relative z-10">
        
        <!-- Header Icon & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-teal-50 text-teal-600 mb-6 shadow-inner border border-teal-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Verifikasi Email</h2>
            <p class="text-sm text-slate-500 mt-3 px-2 leading-relaxed">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.') }}
            </p>
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-center animate-fade-in-up">
                <div class="flex items-center justify-center gap-2 text-emerald-700 font-bold text-sm mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Terkirim!
                </div>
                <p class="text-xs text-emerald-600">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </p>
            </div>
        @endif

        <!-- Actions -->
        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-teal-600 hover:shadow-teal-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2 group">
                    <span>{{ __('Kirim Ulang Email') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm font-bold text-slate-400 hover:text-rose-500 transition duration-300 flex items-center justify-center gap-2 w-full py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Keluar / Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="absolute top-[-60px] left-[-60px] w-40 h-40 bg-teal-200/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-40px] right-[-40px] w-32 h-32 bg-blue-200/20 rounded-full blur-3xl -z-10"></div>
</x-guest-layout>