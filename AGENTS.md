# Aturan kerja agent: Dompet Rantau

## Ruang lingkup dan sumber aturan

Aturan ini berlaku untuk seluruh repo. Baca `design.md` sebelum membuat atau mengubah UI; dokumen tersebut adalah sumber kebenaran desain. Ikuti instruksi pengguna dan aturan agent dengan prioritas lebih tinggi. Jika ada aturan direktori yang lebih spesifik, terapkan dalam cakupannya tanpa mengabaikan prinsip global.

## Konteks proyek

- Stack saat panduan dibuat: Laravel 12 / PHP 8.2+, Blade, Tailwind CSS 3, Alpine.js, Vite, Laravel Breeze, dan Dompdf.
- Periksa manifest/config yang aktual sebelum bekerja; jangan mengasumsikan upgrade atau dependency sudah terpasang.
- Views: `resources/views/`; komponen bersama: `resources/views/components/`; layout: `resources/views/layouts/`.
- Style global: `resources/css/app.css`; JavaScript: `resources/js/app.js`; rute: `routes/web.php` dan `routes/auth.php`.
- UI: font Plus Jakarta Sans dan ikon Phosphor dibundel lokal lewat Vite. Catatan progres UI hanya di `docs/ui-progress.md`.
- Domain utama: kantong, transaksi, transfer, tagihan, laporan, dan profil pengguna.

## Cara bekerja

1. Baca aturan terkait dan jalankan `git status --short`. Pahami perubahan pengguna sebelum mengedit.
2. Telusuri implementasi dengan `rg`; baca file terkait secukupnya. Jangan mencetak isi `.env` atau credential ke output.
3. Kerjakan perubahan terkecil yang menuntaskan permintaan. Pengecualian: untuk tugas redesain atau migrasi UI, cakupan mengikuti tahap yang diminta di prompt. Pertahankan perubahan pengguna; jangan reset, checkout, atau menimpa pekerjaan mereka.
4. Gunakan pola Laravel/Blade/Alpine yang sudah ada. Jangan menambah framework, dependency, atau upgrade major version tanpa kebutuhan yang jelas dalam tugas.
5. Jalankan verifikasi sesuai perubahan dan laporkan hasil serta batas verifikasi secara jujur.

## Aturan desain wajib

- Ikuti token, tipografi, spacing, bahasa Indonesia, dan perilaku komponen di `design.md` untuk seluruh bagian UI yang disentuh.
- Gunakan komponen Blade bersama sebelum membuat markup duplikat. Semua varian baru harus memiliki fungsi yang jelas.
- Definisikan warna baru hanya di token global dan dokumentasikan di `design.md`; hindari hex, inline style, dan arbitrary values tersebar untuk aturan berulang.
- Tema fun tidak boleh mengurangi keterbacaan nominal, aksesibilitas, atau kejelasan tindakan finansial.
- Pertahankan arti warna pemasukan, pengeluaran, transfer, dan status tagihan di semua halaman dan ekspor.
- Semua fitur UI baru memiliki state normal, empty, loading, error, dan success yang relevan, serta dukungan mobile dan keyboard.
- Jangan menambah rute dummy, link `#` untuk aksi nyata, nominal rekaan, atau pesan sukses sebelum respons server berhasil.
- Jika tugas mengubah keputusan desain global, perbarui `design.md` bersamaan dengan implementasinya. Penyimpangan lokal harus didokumentasikan dengan alasan dan cakupan.

## Mobile dan desktop setara

- Rancang mobile (390px) lebih dulu, lalu perluas ke tablet dan desktop. Gaya dasar untuk mobile, perluasan lewat breakpoint.
- Ikuti `design.md` Bagian 12 (fun modern pass) dan Bagian 13 (paritas desktop dan mobile).
- Tidak ada konten, aksi, atau ciri khas visual yang hanya ada di satu perangkat.
- Target sentuh minimal 44px, aksi utama terjangkau ibu jari, gunakan safe area dan `dvh`, font input minimal 16px, tanpa horizontal scroll halaman.
- Setiap efek hover wajib punya padanan sentuh.
- Animasi mengikuti token dan katalog di `design.md` Bagian 7 dan 12, hanya `transform`, `opacity`, dan `clip-path` (plus `stroke-dashoffset` pada SVG), serta hormati `prefers-reduced-motion`.

## Kualitas kode

- Dilarang menulis komentar, TODO, FIXME, kode mati, `console.log`, atau catatan sementara di file kode (PHP, Blade, JS, CSS). Kode menjelaskan dirinya lewat nama yang jelas.
- Satu file satu tanggung jawab. Fungsi pendek, nama deskriptif, tanpa angka ajaib (gunakan token).
- Warna, durasi, dan easing hanya dari token global.
- Jalankan `vendor/bin/pint --dirty` untuk PHP dan formatter atau lint yang tersedia untuk JS dan CSS sebelum menyatakan selesai.
- Catatan progres hanya di `docs/ui-progress.md`.

## Cakupan dan commit

- Untuk tugas redesain atau migrasi UI, cakupan mengikuti tahap yang diminta di prompt, bukan aturan "perubahan terkecil".
- Commit per tahap diizinkan bila diminta di prompt. Push, publish, dan deploy tidak pernah dilakukan agent.

## Data dan keamanan aplikasi

- Jangan memasukkan `.env`, APP_KEY, password, token, atau data finansial pribadi ke dokumentasi, fixture, screenshot, maupun commit. Contoh konfigurasi memakai placeholder di `.env.example`.
- Jangan mengubah `.env` atau merotasi kunci aplikasi kecuali menjadi bagian tugas yang diminta.
- Jangan commit file `*.sql` atau backup database.
- Pertahankan middleware autentikasi, otorisasi kepemilikan data, validasi server, CSRF, dan escaping Blade. Hindari output HTML mentah dari input pengguna.
- Perubahan tampilan tidak boleh mengubah perhitungan saldo, presisi uang, tanggal, atau aturan bayar/transfer tanpa permintaan terkait.
- Untuk perubahan mutasi keuangan, gunakan pola transaksi database yang sesuai dan verifikasi saldo/kepemilikan dengan test bermakna.
- Jangan menjalankan `migrate:fresh`, truncate, seed destruktif, atau menghapus data pengguna tanpa otorisasi eksplisit untuk tindakan tersebut.

## Skill dan referensi

- Untuk arah visual gunakan skill `frontend-design`; untuk konsistensi UI, responsive, dan aksesibilitas gunakan `ui-ux-pro-max` jika tersedia di sesi.
- Baca `SKILL.md` sebelum menerapkan skill. Sesuaikan rekomendasi dengan repo dan `design.md`; jangan menyalin hasil pencarian generik tanpa menilai kecocokannya.
- Untuk pengujian browser gunakan skill browser atau `webapp-testing` yang tersedia. Jangan menyatakan pengujian visual selesai jika hanya menjalankan build.
- Bila tugas memerlukan skill dari GitHub, periksa skill yang sudah tersedia lebih dahulu. Gunakan `skill-installer` untuk instalasi yang diminta; pilih sumber tepercaya, baca instruksi/script sebelum menjalankannya, dan jangan memasang paket eksternal untuk tugas yang sudah bisa diselesaikan dengan skill lokal.
- Skill bukan dependency aplikasi. Jangan menyalin direktori skill global ke repo atau membuat instruksi yang bergantung pada path pribadi mesin pengembang.

## Verifikasi sesuai perubahan

| Perubahan | Pemeriksaan |
| --- | --- |
| Dokumentasi saja | Periksa path, tautan lokal, isi, dan `git diff --check`; build/test aplikasi tidak wajib |
| Blade, CSS, JS | `npm run build`; periksa halaman terdampak pada mobile/desktop, keyboard, dan state yang berubah |
| Redesain atau migrasi UI | Screenshot nyata di 320, 390, 768, 1024, 1440px; uji sentuh, reduced-motion, JS mati, tanpa View Transitions, nama panjang, nominal besar dan negatif, empty state, validasi gagal; kontras pasangan warna baru |
| Halaman utama (Dashboard, Landing) | Lighthouse mobile: Performance minimal 85, Accessibility minimal 95 |
| PHP | `vendor/bin/pint --dirty` jika tersedia; `php artisan test` atau test terarah yang relevan |
| Saldo, transfer, bayar tagihan, otorisasi | Test untuk nilai benar, validasi gagal, kepemilikan, dan kegagalan mutasi yang relevan |
| PDF | Ekspor contoh tanpa data pribadi; periksa pemotongan tabel, nominal, font, dan page break |

Jalankan test database hanya dengan konfigurasi pengujian yang terisolasi; jangan arahkan ke database pengguna. Jika dependency, database, atau server tidak tersedia, jelaskan pemeriksaan yang belum dapat dijalankan. Jangan membuat test yang hanya menyalin implementasi untuk perubahan dokumen atau style sederhana.

## Penyelesaian tugas

- Periksa diff akhir agar tidak ada perubahan di luar cakupan atau rahasia yang terbawa.
- Sampaikan apa yang berubah, alasan utama, pemeriksaan yang dijalankan, dan keterbatasan yang masih ada secara ringkas.
- Jangan melakukan push, publish, deploy, atau mengirim pesan ke layanan luar. Commit hanya bila diminta di prompt, misalnya commit per tahap.