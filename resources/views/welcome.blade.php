<x-app-layout>
<div class="page">
    <section class="grid lg:grid-cols-2 gap-12 items-center py-8">
        <div class="stack" data-reveal><x-badge icon="wallet">Teman catatan anak rantau</x-badge><h1 class="landing-title">Banyak rencana.<br>Satu dompet yang tertata.</h1><p class="text-muted text-lg">Dari uang kos sampai tabungan pulang, beri setiap kebutuhan kantongnya. Catat transaksi dan kelola tagihan dalam satu tempat.</p><div class="actions"><x-button :href="auth()->check() ? route('dashboard') : route('register')" icon="plus">Mulai catat keuangan</x-button>@guest<x-button :href="route('login')" variant="secondary">Sudah punya akun</x-button>@endguest</div><p class="muted">Mulai dari satu kantong. Lanjutkan dengan kebiasaanmu sendiri.</p></div>
        <div class="landing-preview" aria-label="Ilustrasi kantong untuk kebutuhan sehari-hari" data-landing-idle>
            @foreach([['yellow', 'house', 'Kebutuhan rutin', 'Tempat untuk kos dan tagihan.'], ['teal', 'bowl-food', 'Keseharian', 'Pisahkan kebutuhan harianmu.'], ['violet', 'suitcase-rolling', 'Rencana pulang', 'Sisihkan untuk hal yang kamu tunggu.']] as [$palette, $icon, $title, $text])<div class="pocket" data-palette="{{ $palette }}"><span class="pocket-tab" aria-hidden="true"></span><div class="flex items-center gap-4"><span class="pocket-icon"><x-icon :name="$icon" /></span><div><h2>{{ $title }}</h2><p class="muted mt-2">{{ $text }}</p></div></div></div>@endforeach
        </div>
    </section>
    <section class="stack"><h2>Rapi tanpa bikin ribet</h2><div class="grid md:grid-cols-3 gap-6">@foreach([['wallet', 'Kantong untuk setiap rencana', 'Lihat alokasi kebutuhan dan tabunganmu dengan jelas.'], ['receipt', 'Tagihan mudah dipantau', 'Catat pembayaran penuh atau sebagian, sesuai kebutuhan.'], ['chart-bar', 'Laporan yang terbaca', 'Pahami arus kas dan unduh laporan untuk disimpan.']] as [$icon, $title, $text])<article class="panel stack" data-reveal><x-icon :name="$icon" class="text-primary text-2xl" /><h3>{{ $title }}</h3><p class="muted">{{ $text }}</p></article>@endforeach</div></section>
</div>
</x-app-layout>
