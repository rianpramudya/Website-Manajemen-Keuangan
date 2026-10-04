<x-guest-layout>
    <div class="stack"><x-icon name="sign-in" class="text-primary text-3xl" /><h1>Senang kamu kembali</h1><p class="muted">Masuk dan lanjutkan rencana keuanganmu.</p></div>
    <x-auth-session-status :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="stack">
        @csrf
        <x-field name="email" label="Email" type="email" required autofocus autocomplete="username" />
        <x-field name="password" label="Kata sandi" type="password" required autocomplete="current-password" />
        <label class="btn btn-secondary"><input id="remember_me" type="checkbox" name="remember"> Ingat saya</label>
        <x-button type="submit" class="w-full" icon="sign-in">Masuk</x-button>
        @if(Route::has('password.request'))<x-button variant="tertiary" :href="route('password.request')">Lupa kata sandi?</x-button>@endif
        <p class="muted">Belum punya akun? <x-button variant="tertiary" :href="route('register')">Daftar</x-button></p>
    </form>
</x-guest-layout>
