<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __("Perbarui nama profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">{{ __('Nama Lengkap') }}</label>
            <div class="relative">
                <input type="text" name="name" class="w-full p-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-blue-500 transition" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">{{ __('Email') }}</label>
            <div class="relative">
                <input type="email" name="email" class="w-full p-4 rounded-2xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-blue-500 transition" value="{{ old('email', $user->email) }}" required autocomplete="username">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <p class="text-sm text-amber-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="underline text-sm text-amber-600 hover:text-amber-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold shadow-lg hover:bg-blue-600 hover:shadow-blue-500/30 transition transform active:scale-95">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-600 font-bold flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>