<x-guest-layout>
    <h1>Lupa kata sandi?</h1><p class="muted">Masukkan email akunmu untuk menerima tautan pengaturan ulang.</p><x-auth-session-status :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }}" class="stack">@csrf<x-field name="email" label="Email" type="email" required autofocus autocomplete="username" /><x-button type="submit">Kirim tautan reset</x-button></form><x-button variant="tertiary" :href="route('login')">Kembali ke masuk</x-button>
</x-guest-layout>
