# Progres migrasi UI

Branch: ui/design-system-migration. Baseline pengguna: composer.lock dan config/database.php sudah berubah; keduanya tidak diedit atau dimasukkan commit UI. AGENTS.md dan design.md dibaca lengkap.

## Brief
1. Token fuchsia dan delapan warna kantong di CSS/Tailwind.
2. Font Plus Jakarta Sans dan ikon Phosphor lokal.
3. Komponen tombol, field, nominal, kantong bertab, modal, toast, badge, skeleton, progres.
4. Navigasi bersama pada app, guest, landing.
5. Dashboard dan kantong memakai konten server, reveal, count-up visual.
6. Transaksi dan tagihan mempertahankan endpoint, input, dan kalkulator bulk.
7. Laporan memakai bar chart HTML yang tetap terbaca tanpa JS.
8. PDF memakai stylesheet lokal khusus renderer tanpa motion/CDN.
9. Auth dan profil mempertahankan kontrak Breeze.
10. Tidak memakai library animasi.
11. Pengujian database hanya SQLite terisolasi.
12. Commit eksplisit per tahap, tanpa push.

## Keputusan
- Palet dipilih deterministik dari ID kantong; tidak menambah kolom atau mengubah data.
- Bar kantong menunjukkan komposisi saldo yang tersedia, bukan target rekaan.
- Count-up memakai overlay visual aria-hidden; teks nominal final selalu tetap di DOM.
- Pint dibatasi ke file UI/test agar perubahan config milik pengguna tidak diformat.

## Status
Tahap 1 sedang dikerjakan.

## Tahap 1 selesai
- Token, komponen dasar, font/ikon lokal, navigasi bersama app/guest, form loading dan modal native dibuat.
- Dependency: @fontsource/plus-jakarta-sans dan @phosphor-icons/web; bundling lokal menghapus kebutuhan CDN.
- Pint dengan pengecualian config/app/database/routes/bootstrap lulus. Pemanggilan pertama Pint menyentuh config pengguna; perubahan formatter dikembalikan sebelum lanjut.
- npm run build lulus; masih ada peringatan metadata browser lama dari tooling yang sudah ada.
- php artisan test: 25 lulus, 61 assertions, SQLite :memory: sesuai phpunit.xml.
- Halaman lama belum dimigrasikan; pemeriksaan visual lengkap dilakukan sesudah tahap 4.

## Tahap 2 selesai
- Dashboard, indeks dan detail kantong memakai kartu bertab dan komponen transaksi bersama.
- Count-up visual, reveal maksimal delapan item bergelombang, hover tab/ikon, pencarian kantong tanpa menghilangkan fallback server.
- Tidak ada target kantong dalam model: tidak menampilkan target atau persen rekaan; progres dipakai untuk pembayaran/data laporan yang memiliki pembagi nyata.
- Pint lulus, build lulus, test sebelumnya 25 lulus; test UI tambahan 2 lulus (14 assertions), mencakup empty state, escaping nama, saldo negatif besar.
- Berikutnya: transaksi, tagihan, kalkulator bulk dan efek peristiwa yang dikonfirmasi server.
