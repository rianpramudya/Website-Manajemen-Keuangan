<div class="stack"><h2>Informasi profil</h2><p class="muted">Perbarui nama dan alamat email akunmu.</p>
<form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>
<form method="POST" action="{{ route('profile.update') }}" class="stack">@csrf @method('PATCH')
    <x-field name="name" id="profile-name" label="Nama lengkap" :value="$user->name" required autocomplete="name" />
    <x-field name="email" id="profile-email" label="Email" type="email" :value="$user->email" required autocomplete="username" />
    @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())<p class="muted">Email belum diverifikasi.</p><x-button type="submit" form="send-verification" variant="secondary">Kirim ulang verifikasi</x-button>@if(session('status') === 'verification-link-sent')<p role="status" class="badge badge-success">Tautan verifikasi berhasil dikirim.</p>@endif @endif
    <x-button type="submit">Simpan perubahan</x-button>@if(session('status') === 'profile-updated')<p role="status" class="badge badge-success">Perubahan profil berhasil disimpan.</p>@endif
</form></div>
