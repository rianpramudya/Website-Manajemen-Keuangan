<x-guest-layout>
    <div class="stack"><x-icon name="user-plus" class="text-primary text-3xl" /><h1>Mulai rencanamu</h1><p class="muted">Buat akun untuk menata kantong dan catatanmu.</p></div>
    <form method="POST" action="{{ route('register') }}" class="stack">@csrf
        <x-field name="name" label="Nama lengkap" required autofocus autocomplete="name" />
        <x-field name="email" label="Email" type="email" required autocomplete="username" />
        <x-field name="password" label="Kata sandi" type="password" required autocomplete="new-password" />
        <x-field name="password_confirmation" label="Ulangi kata sandi" type="password" required autocomplete="new-password" />
        <x-button type="submit" class="w-full">Daftar</x-button><p class="muted">Sudah punya akun? <x-button variant="tertiary" :href="route('login')">Masuk</x-button></p>
    </form>
</x-guest-layout>
