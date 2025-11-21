<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-rose-600">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap unduh data apa pun yang ingin Anda simpan sebelum menghapus.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
        class="px-6 py-3 rounded-xl bg-rose-100 text-rose-600 font-bold border border-rose-200 hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-500/30 transition transform active:scale-95">
        {{ __('Hapus Akun Saya') }}
    </button>

    <!-- Modal Konfirmasi -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white rounded-[2rem]">
            @csrf
            @method('delete')

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">
                    {{ __('Apakah Anda yakin ingin menghapus akun?') }}
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    {{ __('Setelah akun dihapus, semua data akan hilang permanen. Masukkan password Anda untuk konfirmasi.') }}
                </p>
            </div>

            <div class="mt-6">
                <label class="sr-only" for="password">Password</label>
                <input type="password" name="password" id="password" class="w-full p-4 rounded-xl bg-slate-50 border-none text-slate-900 font-bold focus:ring-2 focus:ring-rose-500 text-center" placeholder="Masukkan Password Anda">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-center" />
            </div>

            <div class="mt-6 flex justify-center gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold hover:bg-slate-50 transition">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="px-6 py-3 rounded-xl bg-rose-600 text-white font-bold shadow-lg shadow-rose-500/30 hover:bg-rose-700 transition transform active:scale-95">
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>