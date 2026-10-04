<x-app-layout>
<div class="page">
    <section class="landing-hero">
        <div class="stack" data-reveal><x-badge tone="warning" icon="wallet">Teman catatan anak rantau</x-badge><h1 class="landing-title">Banyak rencana.<br>Satu dompet yang tertata.</h1><p class="hero-copy">Dari uang kos sampai tabungan pulang, beri setiap kebutuhan kantongnya. Catat transaksi dan kelola tagihan dalam satu tempat.</p><div class="actions"><x-button :href="auth()->check() ? route('dashboard') : route('register')" icon="plus">Mulai catat keuangan</x-button>@guest<x-button :href="route('login')" variant="secondary">Sudah punya akun</x-button>@endguest</div><p class="muted">Mulai dari satu kantong. Lanjutkan dengan kebiasaanmu sendiri.</p></div>
        <div class="hero-art" data-landing-idle><x-illustration kind="full" /><p>Setiap rencana punya kantongnya.</p><div class="hero-plans"><span>Kebutuhan rutin</span><span>Keseharian</span><span>Rencana pulang</span></div></div>
    </section>
    <section class="stack"><h2>Rapi tanpa bikin ribet</h2><div class="grid md:grid-cols-3 gap-6">@foreach([['wallet', 'Kantong untuk setiap rencana', 'Lihat alokasi kebutuhan dan tabunganmu dengan jelas.'], ['receipt', 'Tagihan mudah dipantau', 'Catat pembayaran penuh atau sebagian, sesuai kebutuhan.'], ['chart-bar', 'Laporan yang terbaca', 'Pahami arus kas dan unduh laporan untuk disimpan.']] as [$icon, $title, $text])<article class="panel stack" data-reveal><x-icon :name="$icon" class="text-primary text-2xl" /><h3>{{ $title }}</h3><p class="muted">{{ $text }}</p></article>@endforeach</div></section>
</div>
</x-app-layout>
