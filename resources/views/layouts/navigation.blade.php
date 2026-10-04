<nav class="nav-shell" aria-label="Navigasi utama">
    <div class="nav-inner">
        <a class="brand" href="{{ auth()->check() ? route('dashboard') : url('/') }}"><span class="brand-icon"><x-icon name="wallet" /></span>Dompet Rantau</a>
        @auth
        <div class="app-tabs" data-navigation><span class="nav-pill" aria-hidden="true"></span>@include('layouts.navigation-links')</div>
        <details class="account-menu"><summary class="nav-link cursor-pointer" aria-label="Menu akun"><x-icon name="user-circle" /><span>Akun</span></summary><div class="panel stack"><p class="font-bold break-words">{{ auth()->user()->name }}</p><a class="nav-link" href="{{ route('profile.edit') }}">Profil</a><form method="POST" action="{{ route('logout') }}">@csrf<x-button type="submit" variant="secondary">Keluar</x-button></form></div></details>
        @else
        <div class="actions"><x-button :href="route('login')" variant="tertiary">Masuk</x-button><x-button :href="route('register')">Daftar</x-button></div>
        @endauth
    </div>
</nav>
