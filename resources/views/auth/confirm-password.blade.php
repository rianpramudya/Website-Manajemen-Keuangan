<x-guest-layout>
    <h1>Konfirmasi kata sandi</h1><p class="muted">Masukkan kata sandi untuk melanjutkan ke pengaturan ini.</p><form method="POST" action="{{ route('password.confirm') }}" class="stack">@csrf<x-field name="password" label="Kata sandi" type="password" required autocomplete="current-password" /><x-button type="submit">Konfirmasi</x-button></form>
</x-guest-layout>
