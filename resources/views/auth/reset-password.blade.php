<x-guest-layout>
    <h1>Kata sandi baru</h1><p class="muted">Buat kata sandi yang hanya kamu ketahui.</p>
    <form method="POST" action="{{ route('password.store') }}" class="stack">@csrf<input type="hidden" name="token" value="{{ $request->route('token') }}"><x-field name="email" label="Email" type="email" :value="$request->email" readonly required autocomplete="username" /><x-field name="password" label="Kata sandi baru" type="password" required autocomplete="new-password" /><x-field name="password_confirmation" label="Ulangi kata sandi" type="password" required autocomplete="new-password" /><x-button type="submit">Simpan kata sandi</x-button></form>
</x-guest-layout>
