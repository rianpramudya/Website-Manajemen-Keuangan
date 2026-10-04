# Bukti fun modern pass

Bukti berasal dari Chromium/Playwright pada server aset produksi lokal dan database SQLite pengujian terisolasi. Akun, nominal ekstrem, dan nama pada gambar adalah fixture pengujian sintetis; tidak ada data pengguna. Cookie autentikasi dan laporan Lighthouse mentah tidak disertakan.

| Halaman | Mobile 390 | Desktop 1440 | Konten dan aksi sama |
| --- | --- | --- | --- |
| Dashboard | [gambar](dashboard-390.png) | [gambar](dashboard-1440.png) | Lulus |
| Kantong | [gambar](kantong-390.png) | [gambar](kantong-1440.png) | Lulus |
| Transaksi | [gambar](transaksi-390.png) | [gambar](transaksi-1440.png) | Lulus |
| Tagihan | [gambar](tagihan-390.png) | [gambar](tagihan-1440.png) | Lulus |
| Laporan | [gambar](laporan-390.png) | [gambar](laporan-1440.png) | Lulus |
| Landing | [gambar](landing-390.png) | [gambar](landing-1440.png) | Lulus |
| Auth | [gambar](auth-390.png) | [gambar](auth-1440.png) | Lulus |
| Profil | [gambar](profil-390.png) | [gambar](profil-1440.png) | Lulus |
| Detail kantong | [gambar](detail-390.png) | [gambar](detail-1440.png) | Lulus |

## Hasil

- 45 screenshot halaman pada 320, 390, 768, 1024, 1440px; seluruh respons berhasil dan tidak ada horizontal overflow.
- 36 screenshot emulasi iPhone SE, iPhone 14, Pixel 7, iPad; ditambah 61 screenshot auth, empty state, fallback dan landscape. Semua matriks lengkap ada di `/tmp/dompet-fun-artifacts`; pasangan 390/1440 dan hasil JSON disimpan di sini.
- Modal: fokus terperangkap, Escape, pengembalian fokus, drag dengan alternatif tombol. Tab mendukung keyboard; toast aria-live dan timer berhenti saat hover/fokus.
- Tanpa JavaScript, reduced-motion, tanpa View Transitions: halaman dan aksi tetap tersedia. Shared element kantong ke detail berhasil pada navigasi GET. POST tetap navigasi server biasa.
- Loading submit menjaga payload uang final; validasi server mempertahankan input. Konfeti hanya setelah transaksi pertama berhasil atau seluruh tagihan bulanan lunas; batas 16 partikel pada sentuh teruji.
- Pint bersih dengan pengecualian file pengguna; 30 test / 88 assertion di database terisolasi. Build berhasil, masih ada warning metadata Browserslist/baseline-browser-mapping yang sudah ada.
- Lighthouse mobile produksi, cache dingin: Dashboard Performance 87 / Accessibility 100; Landing 91 / 100.
- 13 pemeriksaan kontras lulus. Gradien minimum 6,32:1 untuk putih, 4,93:1 untuk teks putih opacity 0,85.
- PDF sintetis empat halaman: teks dalam batas halaman, kepala tabel tidak menimpa baris; tanpa CDN, motion, atau gradien.

## Batas pengujian

Perangkat adalah emulasi Chromium, bukan perangkat fisik. Safari/Firefox belum diuji. VisualViewport 400px disimulasikan dan bar aksi tetap terlihat; keyboard virtual sistem operasi belum diuji. Screenshot diperiksa secara visual, hasil Lighthouse merupakan pengukuran lokal dan bisa berubah menurut perangkat/server.
