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

## Tahap 3 selesai
- Riwayat transaksi, kartu tagihan, create/edit/pay/delete, tambah saldo, dan bulk payment dimigrasikan.
- Kalkulator bulk dipindah ke modul Alpine; rumus pembulatan/persen/grandTotal dipertahankan.
- Label perkiraan membedakan simulasi pembayaran dari status server.
- Efek centang toast, highlight transaksi baru, koin pemasukan/transfer terlihat, dan pop Lunas dipicu pesan sukses server. Reduced motion dan perangkat terbatas melewati perayaan.
- Pint lulus, build lulus, suite 27 lulus; test UI terbaru 3 lulus (18 assertions), termasuk nama tagihan dengan tanda kutip/HTML dan kontrak form bulk/pay.
- Berikutnya: laporan/PDF, seluruh auth, landing, profil; lalu pengujian browser terisolasi dan polish.

## Migrasi tahap 4 — selesai
- Laporan, PDF lokal, enam halaman auth, landing, profil, dan fallback tanpa JS selesai.
- Build berhasil; Pint dengan pengecualian perubahan pengguna bersih; 30 test / 88 assertion lulus di SQLite terisolasi.
- Playwright: 59 screenshot, pemeriksaan modal, validasi, loading, transfer, pembayaran, hapus, tanpa JS dan reduced-motion lulus. 12 pasangan kontras lulus.
- PDF sintetis: empat halaman, tabel dan teks dalam batas halaman. Artefak tersedia di /tmp/dompet-ui-artifacts.
- Perubahan composer.lock dan config/database.php milik pengguna tidak disertakan. Tidak ada push.

## Fun modern pass — mulai
- Instruksi terbaru Bagian 12–13 mengungguli fondasi lama. Baseline migrasi disimpan sebelum branch upgrade.

### Upgrade tahap 1 — selesai
- Mobile 390px sebagai dasar: bottom navigation lima tab, pill pegas, safe area, CTA lengket, bottom sheet dengan fokus native. Desktop memakai rail bersama.
- Token radius 14/24/28, gradien primary–violet-deep, spring linear, jahitan kantong, stiker positif, tipografi uang. Tidak ada dependency baru.
- Build/Pint bersih; 30 test (88 assertion) lulus; 45 screenshot pada 320/390/768/1024/1440, tanpa overflow atau error JS. Bar aksi diperbaiki agar tidak terperangkap transform header.
- Artefak /tmp/dompet-fun-artifacts/stage1.

### Upgrade tahap 2 — selesai
- Dashboard mobile berurutan: saldo, dua statistik, carousel snap, transaksi terbaru, formulir. Desktop bento asimetris dengan formulir di samping.
- Odometer digit berbasis CSS menjaga nilai akhir; maksimal delapan nominal dianimasikan. Efek tekan mobile, tilt desktop dengan satu scheduler rAF, tombol pegas/shine, progres bergelombang.
- Build/Pint bersih; 30 test / 88 assertion lulus; 45 screenshot lima lebar tanpa overflow. Skrip QA dikoreksi: Kantong /pockets, Auth/Landing sesi tamu, respons HTTP wajib 200. Screenshot Kantong tahap 1 sebelumnya tidak sah (405), bukti terkoreksi ada pada tahap 2.
- Tanpa dependency baru; artefak /tmp/dompet-fun-artifacts/stage2.

### Upgrade tahap 3 — selesai
- View Transitions lintas halaman dan nama shared element per kantong, dengan navigasi tetap. Scroll reveal CSS memakai fallback IntersectionObserver.
- Tab Riwayat/Info punya keyboard panah dan fallback tanpa JS; filter crossfade; bottom sheet dapat ditarik dengan alternatif tutup/Escape. Toast pegas, timebar berhenti saat hover/fokus; VisualViewport menghindari keyboard.
- Build/Pint bersih; 30 test / 88 assertion lulus; 45 screenshot tanpa overflow; delapan kelompok interaksi/fallback lulus tanpa error JS.
- Lighthouse awal Dashboard mobile: Performance 98, Accessibility 95. Temuan kontras akan dipoles di tahap 4. Tidak ada dependency runtime baru.
