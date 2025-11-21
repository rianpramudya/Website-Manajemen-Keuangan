<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900">
            {{ __('Perbarui Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">{{ __('Password Saat Ini') }}</label>
            <input type="password" name="current_password" class="w-full p-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-amber-500 transition" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">{{ __('Password Baru') }}</label>
            <input type="password" name="password" class="w-full p-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-amber-500 transition" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">{{ __('Konfirmasi Password') }}</label>
            <input type="password" name="password_confirmation" class="w-full p-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-amber-500 transition" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold shadow-lg hover:bg-amber-500 hover:shadow-amber-500/30 transition transform active:scale-95">
                {{ __('Simpan Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-600 font-bold flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>