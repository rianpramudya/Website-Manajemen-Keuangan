<nav class="nav-shell" aria-label="Navigasi utama">
    <div class="nav-inner">
        <a class="brand" href="{{ auth()->check() ? route('dashboard') : url('/') }}"><span class="brand-icon"><x-icon name="wallet" /></span>Dompet Rantau</a>
        @auth
        <details class="md:hidden w-full"><summary class="btn btn-secondary">Menu navigasi</summary><div class="nav-links pt-4">@include('layouts.navigation-links')</div></details>
        <div class="hidden md:flex nav-links">@include('layouts.navigation-links')</div>
        @else
        <div class="actions"><x-button :href="route('login')" variant="tertiary">Masuk</x-button><x-button :href="route('register')">Daftar</x-button></div>
        @endauth
    </div>
</nav>
