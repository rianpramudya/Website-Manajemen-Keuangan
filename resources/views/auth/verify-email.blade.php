<x-guest-layout>
    <h1>Verifikasi emailmu</h1><p class="muted">Buka tautan verifikasi yang dikirim ke emailmu untuk melanjutkan.</p>
    @if(session('status') === 'verification-link-sent')<p role="status" class="badge badge-success">Tautan verifikasi baru berhasil dikirim.</p>@endif
    <form method="POST" action="{{ route('verification.send') }}">@csrf<x-button type="submit">Kirim ulang email</x-button></form><form method="POST" action="{{ route('logout') }}">@csrf<x-button type="submit" variant="secondary">Keluar</x-button></form>
</x-guest-layout>
