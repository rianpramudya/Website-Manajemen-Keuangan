# Design system: Dompet Rantau

Sumber aturan visual dan interaksi untuk seluruh aplikasi: landing, autentikasi, dashboard, kantong, transaksi, tagihan, laporan, profil, modal, dan komponen bersama.

Tema: **fun, modern, ramah, rapi**, seperti buku catatan keuangan anak rantau dengan kantong warna-warni yang berjahit. Rapi untuk data, hidup dan mulus untuk interaksi.

Status: panduan target. UI lama belum otomatis memenuhi aturan ini. Jangan menganggap semua token sudah ada di kode.

## 0. Ringkasan (baca ini dulu)

1. Angka dan tindakan utama terbaca lebih dulu daripada dekorasi.
2. Permukaan terang. Panel ringkasan utama per halaman boleh memakai gradien brand; kartu data, tabel, dan formulir tetap tenang.
3. Keseruan datang dari: jahitan dan tab pada kantong, dashboard bento, tipografi angka besar, stiker status, transisi antarhalaman, dan animasi pegas yang konsisten (Bagian 7 dan 12).
4. Brand fuchsia, bahaya merah. Keduanya tidak boleh tertukar.
5. Satu bahasa gerak: token durasi dan easing yang sama di semua animasi. Utamakan `transform`, `opacity`, dan `clip-path`.
6. Hormati `prefers-reduced-motion`. Animasi tidak pernah menunda atau menghalangi tindakan pengguna.
7. Kode tanpa komentar, TODO, atau `console.log`.
8. Dark mode: tidak didukung. Jangan menambahkannya.

## 1. Prinsip

- Komponen dengan fungsi sama wajib sama bentuk, warna, label, dan perilaku di semua halaman.
- Kesalahan, tagihan terlambat, dan tindakan hapus harus jelas dan serius. Tanpa candaan yang menyalahkan pengguna dan tanpa animasi main-main.
- Animasi menjelaskan perubahan (uang masuk, uang pindah, tagihan lunas), bukan sekadar menghias.
- Jangan menambah dekorasi pada setiap elemen. Satu ciri khas kuat per komposisi, elemen lain lebih tenang.

## 2. Token warna

CSS variables di `resources/css/app.css`, dipetakan ke Tailwind. Nilai warna hanya didefinisikan di sumber token, bukan di view.

| Token | Nilai | Fungsi |
| --- | --- | --- |
| `--color-bg` | `#F8FAFC` | Latar halaman |
| `--color-surface` | `#FFFFFF` | Kartu, formulir, modal |
| `--color-text` | `#0F172A` | Judul, isi, nominal |
| `--color-muted` | `#475569` | Label dan teks pendukung |
| `--color-border` | `#CBD5E1` | Pemisah dan batas kartu |
| `--color-control-border` | `#64748B` | Batas input dan kontrol |
| `--color-primary` | `#A21CAF` | CTA utama, link, navigasi aktif |
| `--color-primary-hover` | `#86198F` | Hover CTA utama |
| `--color-on-primary` | `#FFFFFF` | Teks pada CTA utama |
| `--color-primary-soft` | `#FDF4FF` | Aksen brand ringan |
| `--color-violet-deep` | `#5B21B6` | Ujung gradien panel ringkasan dan hero landing |
| `--color-accent` | `#FBBF24` | Dekorasi kantong dan sorotan |
| `--color-on-accent` | `#0F172A` | Teks pada aksen kuning |
| `--color-success` | `#047857` | Pemasukan, berhasil, lunas |
| `--color-success-soft` | `#ECFDF5` | Latar status berhasil |
| `--color-warning` | `#92400E` | Mendekati jatuh tempo |
| `--color-warning-soft` | `#FFFBEB` | Latar peringatan |
| `--color-danger` | `#B91C1C` | Pengeluaran, gagal, hapus |
| `--color-danger-soft` | `#FEF2F2` | Latar status bahaya |
| `--color-info` | `#1D4ED8` | Transfer dan informasi netral |
| `--color-info-soft` | `#EFF6FF` | Latar informasi |
| `--color-focus` | `#1D4ED8` | Outline fokus keyboard |

Aturan:
- Fuchsia = identitas brand. Merah = bahaya dan pengeluaran. Merah selalu disertai label atau ikon status.
- Kuning selalu dengan teks gelap.
- Jangan mengandalkan warna saja untuk membedakan pemasukan, pengeluaran, dan transfer. Tambahkan label dan ikon.
- Merah tidak dipakai untuk tombol biasa, navigasi, atau dekorasi.
- Gradien hanya di panel ringkasan utama dan hero landing.

### Palet kategori kantong

Delapan pasangan tetap. Kantong baru memilih dari daftar ini, tidak boleh membuat warna sendiri. Teks di atas warna soft selalu `--color-text`. Warna kuat dipakai untuk ikon, tab kantong, jahitan, dan bar progres.

| Nama | Kuat | Soft |
| --- | --- | --- |
| Kuning | `#FBBF24` | `#FFFBEB` |
| Teal | `#0F766E` | `#F0FDFA` |
| Violet | `#6D28D9` | `#F5F3FF` |
| Jingga | `#C2410C` | `#FFF7ED` |
| Langit | `#0369A1` | `#F0F9FF` |
| Lime | `#4D7C0F` | `#F7FEE7` |
| Indigo | `#4338CA` | `#EEF2FF` |
| Batu | `#475569` | `#F1F5F9` |

Warna kategori tidak mengubah arti status keuangan.

## 3. Tipografi dan angka

- **Plus Jakarta Sans**, fallback `ui-sans-serif, system-ui, sans-serif`. Sama di landing, auth, dan aplikasi.
- Body 16px/1.5, weight 400-500. Teks pendukung 14px/1.5. Label kecil 12px/1.5 hanya untuk metadata.
- Judul halaman: 28px mobile, 32px desktop, weight 800, line-height 1.2. Judul bagian: 20px/1.3, weight 700.
- Saldo utama: 32px mobile, 40px desktop, weight 800 (di panel ringkasan utama boleh sampai 56px desktop). Nominal membungkus tanpa keluar dari kartu.
- Sentence case. Hindari label huruf kapital panjang.
- Nominal: `font-variant-numeric: tabular-nums`, rata kanan di tabel, rata kiri di kartu ringkasan. Pada nominal besar, "Rp" boleh lebih kecil dan lebih redup dari angkanya.
- Format mata uang: `Rp 1.250.000`. Negatif: `-Rp 50.000` (tanda minus di depan "Rp"). Jangan membulatkan nilai tersimpan demi tampilan.
- Tanggal UI: `4 Okt 2026`. Gunakan zona waktu aplikasi, jangan hardcode zona lain di view.

## 4. Spacing, bentuk, layout

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `--space-1` sampai `--space-8` | 4, 8, 12, 16, 20, 24, 32, 48px | Skala spacing |
| `--radius-control` | 14px | Input dan tombol |
| `--radius-card` | 24px | Kartu dan panel |
| `--radius-modal` | 28px | Modal dan panel utama |
| `--radius-pill` | 9999px | Badge, stiker, dan avatar |
| `--shadow-card` | `0 4px 16px rgb(15 23 42 / 0.06)` | Kartu yang perlu elevasi |
| `--shadow-overlay` | `0 16px 48px rgb(15 23 42 / 0.16)` | Modal dan dropdown |

- Container maksimal 1280px; padding horizontal 16px mobile, 24px tablet, 32px desktop.
- Breakpoint Tailwind: `sm` 640, `md` 768, `lg` 1024, `xl` 1280. Jangan mencampur breakpoint navigasi desktop dan tombol menu mobile.
- Header halaman: judul, penjelasan singkat bila perlu, satu CTA utama. Di mobile CTA turun ke baris berikutnya.
- Gap antarbagian 24-32px. Padding kartu 20px mobile, 24px desktop. Formulir gap 16px.
- Grid kantong: 1 kolom mobile, 2 tablet, 3-4 desktop.
- Jangan beri tinggi tetap pada kartu berisi konten dinamis.
- Satu pola navigasi bersama. Jika header fixed, beri offset konten dan `scroll-padding-top`.
- Layer: konten 0, sticky/header 30, dropdown 40, overlay modal 50, toast 60.

## 5. Komponen standar

### Tombol dan navigasi
- Primary: fuchsia solid, teks putih, weight 700. Satu tindakan utama per area tugas.
- Secondary: putih, teks gelap, border kontrol. Tertiary: teks primary.
- Danger: merah dengan label eksplisit, misalnya "Hapus transaksi". Hanya untuk tindakan destruktif, idealnya di dalam dialog konfirmasi.
- Tinggi kontrol minimal 44px, jarak antartarget minimal 8px. Ikon tombol 20px, gap 8px.
- State wajib: default, hover, focus-visible, disabled, loading. Saat loading, cegah submit ganda dan ubah label ("Menyimpan...").
- Navigasi aktif: primary-soft, teks primary, `aria-current="page"`. Label: Dashboard, Kantong, Riwayat transaksi, Tagihan, Laporan. Profil di menu pengguna. Hanya rute yang tersedia.

### Kartu kantong dan ringkasan
- Urutan tetap: ikon kategori, nama, tipe, nominal.
- **Tab kantong**: tab kecil di tepi atas kartu, dibuat dengan `clip-path` atau SVG inline, warna kuat dari palet kategori, `aria-hidden="true"`. Kartu ringkasan utama memakai tab kuning.
- **Jahitan**: lihat Bagian 12.1.
- Kartu biasa (non-kantong): surface putih, border tipis. Tanpa glow dan gradient.
- Card link punya fokus keyboard jelas. Jangan taruh tombol interaktif di dalam link kartu.

### Input nominal
- Prefix "Rp" terlihat, pemisah ribuan otomatis saat mengetik, `inputmode="numeric"`, `autocomplete="off"`.
- Nilai yang dikirim ke server tanpa pemisah. Validasi server tetap sumber kebenaran.
- Bantuan dan error di dekat field, terhubung lewat `aria-describedby` dan `aria-invalid`.

### Formulir dan modal
- Label terlihat dan terhubung ke input. Placeholder hanya contoh.
- Pertahankan input setelah validasi gagal.
- Modal: judul, isi, lalu Batal dan tindakan utama. Maksimal 560px, mobile `calc(100% - 32px)`.
- Fokus masuk ke modal, terkunci, kembali ke pemicu saat ditutup. Tombol tutup berlabel, Escape menutup.
- Penghapusan: konfirmasi yang menyebut objek dan akibatnya. Tidak ada konfirmasi untuk simpan biasa.

### Tabel, chart, feedback
- Tabel desktop: header jelas, nominal rata kanan, baris minimal 48px, tindakan berlabel.
- Mobile: tabel menjadi **daftar kartu ringkas** (nominal, tanggal, tipe, aksi). Tidak memakai scroll horizontal untuk tabel utama.
- Chart: warna semantik konsisten, legend dan label, plus ringkasan teks atau tabel.
- Empty state: jelaskan apa yang belum ada dan langkah berikutnya, misalnya "Belum ada transaksi. Catat pengeluaran pertamamu."
- Error menyebut masalah dan cara memperbaiki: "Nominal harus lebih dari Rp 0."
- Toast: mobile di bawah tengah, desktop di kanan atas. Sukses hilang setelah 5 detik dan bisa ditutup. Error (`role="alert"`) tidak hilang otomatis. Status biasa memakai `role="status"`.
- Sukses ditampilkan hanya setelah server mengonfirmasi.

## 6. Ikon dan bahasa

- Ikon: **Phosphor** saja. Regular untuk kontrol, fill untuk penanda aktif. 20px di kontrol, 24px di kartu, 16px di metadata. Ikon dekoratif `aria-hidden`; tombol ikon punya accessible name.
- Tanpa emoji sebagai ikon navigasi atau indikator finansial.
- Bahasa UI Indonesia: "Masuk", "Daftar", "Simpan perubahan", "Tambah transaksi", "Buat kantong", "Transfer dana", "Bayar tagihan". Nama tindakan konsisten sampai pesan hasilnya.
- Tone bersahabat, ringan, dan mendukung. Jangan menghakimi kebiasaan belanja. Tanpa istilah teknis backend.

## 7. Motion system

Prinsip: satu bahasa gerak, banyak ekspresi. Gerak terasa **hidup, mulus, dan terkendali**: cepat, lembut, tidak pernah menghalangi.

### 7.1 Token gerak (di `resources/css/app.css`)

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `--dur-fast` | 150ms | Hover, warna, press |
| `--dur-base` | 220ms | Dropdown, modal, toast, transisi halaman |
| `--dur-slow` | 420ms | Reveal kartu, progres, count-up |
| `--dur-moment` | 700ms | Momen perayaan (maksimal, sekali) |
| `--dur-spring` | 520ms | Dipasangkan dengan `--ease-spring-real` |
| `--ease-out` | `cubic-bezier(.22, 1, .36, 1)` | Masuk dan reveal |
| `--ease-in` | `cubic-bezier(.4, 0, 1, 1)` | Keluar |
| `--ease-spring` | `cubic-bezier(.34, 1.4, .64, 1)` | Pop kecil (badge, centang) |
| `--ease-spring-real` | `linear(0, .22 6%, .72 16%, 1.04 28%, 1.07 36%, .99 56%, 1 100%)` | Pegas sungguhan: pop kantong, tab, pill navigasi |
| `--stagger` | 60ms | Jeda antaritem, maksimal 8 item bergelombang |

Semua animasi wajib memakai token ini, tanpa angka acak di view atau komponen.

### 7.2 Aturan teknis
- Animasikan hanya `transform`, `opacity`, dan `clip-path`. Pengecualian: `stroke-dashoffset` pada SVG.
- Utamakan CSS (transition, keyframes, `@starting-style`, scroll-driven animations). JavaScript kecil dan modular untuk count-up, tilt, konfeti, dan orkestrasi. Gunakan Alpine bila sudah ada di proyek. Jangan menambah library animasi tanpa alasan tertulis.
- Animasi sekali jalan saat masuk atau saat terjadi peristiwa. Pengecualian: gerak idle ilustrasi landing (berhenti saat di luar viewport) dan shimmer skeleton selama memuat. Tidak ada loop lain, pulse terus-menerus, atau konfeti otomatis.
- Transisi antarhalaman memakai View Transitions API sebagai progressive enhancement. Tanpa dukungan browser, navigasi tetap normal.
- Animasi tidak boleh menunda tindakan. Elemen interaktif bisa diklik sejak frame pertama.
- Nilai uang di DOM selalu nilai akhir yang benar. Count-up dan odometer hanya efek visual berupa overlay; pembaca layar dan salin teks mendapat nilai akhir.
- Reveal tidak menyembunyikan konten dengan CSS sebelum JS siap. Tanpa JS, semua tampil.
- Tidak ada kedipan lebih dari 3 kali per detik.

### 7.3 Katalog animasi dasar (pakai ini, jangan buat gaya baru)

**Umum**
| Elemen | Animasi |
| --- | --- |
| Tombol | Hover naik 1px dan warna berubah (`fast`). Ditekan: `scale(.97)` (`fast`). Loading: spinner kecil menggantikan ikon, label berubah |
| Kartu interaktif | Hover naik maksimal 2px dan bayangan menguat (`fast`) |
| Tautan navigasi | Indikator aktif meluncur ke item baru (lihat 12.2) |
| Halaman masuk | Judul lalu konten muncul `opacity` + naik 8px, stagger antarblok (`slow`). Hanya saat muat halaman pertama |
| Daftar dan grid | Item masuk bergelombang dengan `--stagger`, maksimal 8 item pertama; sisanya langsung tampil |
| Skeleton loading | Bentuk meniru layout asli, shimmer halus satu arah, tanpa pergeseran layout |
| Modal | Overlay fade, panel naik 12px + fade (`base`). Keluar `ease-in` lebih cepat |
| Dropdown | Fade + turun 4px (`base`) |
| Input fokus | Border dan ring berubah warna (`fast`) |
| Error field | Pesan error muncul fade + turun 4px. Field bergeser horizontal kecil satu kali (maksimal 4px, 2 siklus). Tidak berkedip |

**Khas keuangan (momen fun)**
| Peristiwa | Animasi |
| --- | --- |
| Saldo dan ringkasan | Count-up dari nilai sebelumnya ke nilai baru (`slow`). Pertama kali halaman dibuka: dari 0 |
| Kantong dibuat atau kartu baru muncul | Kartu pop masuk dengan `ease-spring-real`, tab kantong terbuka dengan `clip-path` |
| Hover kartu kantong | Tab kantong naik 2px dan sedikit melebar. Ikon kategori miring 4 derajat sekali |
| Progres bar | Bar terisi dari 0 ke nilai (`slow`, `ease-out`) saat masuk viewport |
| Transaksi berhasil disimpan | Ikon centang tergambar (SVG `stroke-dashoffset`, `base`), toast sukses. Baris baru di riwayat masuk dengan highlight kuning lembut yang memudar |
| Pemasukan | Koin kecil jatuh dari atas ke kantong tujuan (satu kali, `moment`) |
| Transfer dana | Satu koin bergerak melengkung dari kantong asal ke tujuan, kedua saldo count-up. Hanya bila kedua kartu terlihat di layar |
| Tagihan dibayar | Stiker berubah ke "Lunas" dengan pop `ease-spring-real`, centang hijau muncul sekali |
| Tagihan terlambat | Tanpa animasi perayaan atau main-main. Stiker statis, serius, berikut label teks |
| Hapus item | Baris mengecil dan memudar (`base`), daftar di bawahnya naik halus. Tanpa efek dramatis |
| Empty state | Ilustrasi kantong kosong masuk fade + naik sekali. Tombol aksi jelas |
| Landing | Preview kantong bergerak idle halus (naik-turun maksimal 6px, 6 detik, easing lembut). Kartu fitur reveal saat scroll dengan stagger |

### 7.4 Reduced motion dan perangkat
- `prefers-reduced-motion: reduce`: hapus semua translate, scale, stagger, count-up, odometer, tilt, koin, konfeti, view transition, dan idle. Sisakan perubahan opacity dan warna instan atau sangat singkat. Konten tetap tampil penuh.
- Perangkat sentuh: tidak ada animasi yang bergantung hover (tilt, kilau).
- Jika FPS turun atau perangkat hemat daya, momen perayaan (koin, stempel, konfeti) dilewati. Fungsi tetap utuh.
- Satu komponen animasi untuk satu peristiwa. Jangan menduplikasi varian di halaman berbeda.

## 8. Penerapan per halaman

| Area | Aturan khusus |
| --- | --- |
| Landing | Hero bergradien dengan ilustrasi kantong atau preview produk sebagai fokus. CTA "Mulai catat keuangan". Tanpa testimoni atau angka rekaan. Gerak: idle ilustrasi + reveal scroll |
| Auth | Layout guest, token sama, panel form sederhana, error dekat field. Gerak minimal: panel masuk, error field |
| Dashboard | Layout bento: saldo (panel utama), pemasukan/pengeluaran, kantong, transaksi terbaru. Odometer saldo, grid bergelombang |
| Kantong | Kartu berjahit dengan tab. Detail: nama, saldo, tindakan, riwayat. Shared element dari kartu ke detail |
| Transaksi | Tipe berlabel eksplisit. Filter dan format nominal sama di dashboard, riwayat, dan detail. Animasi centang dan highlight baris baru |
| Tagihan | Nominal, jatuh tempo, status, aksi bayar. Terlambat tidak hanya warna. Stiker Lunas |
| Laporan | Periode dan filter jelas, chart dengan angka. Batang tumbuh bertahap saat masuk viewport. Ekspor mempertahankan arti status |
| PDF laporan | Latar putih, font yang didukung renderer, tabel tidak terpotong, kontras aman di grayscale. Tanpa motion, gradien, dan CDN |
| Profil | Komponen bersama. Hapus akun dipisahkan dari pengaturan biasa |

## 9. Implementasi

- Token global di `resources/css/app.css`; pemetaan utility di `tailwind.config.js`. Jangan ubah major version Tailwind.
- Komponen Blade di `resources/views/components/` untuk tombol, field, input nominal, modal, status, stiker, kartu kantong, panel ringkasan, bottom tab bar, dan toast.
- Utilitas animasi di modul JS kecil terpisah per fitur (count-up, odometer, tilt, reveal, koin, konfeti). Satu file satu tanggung jawab, satu loop `requestAnimationFrame` bersama.
- Layout app dan guest berbagi token. Periksa `layouts/app.blade.php` dan `layouts/navigation.blade.php` agar tidak ada dua sistem navigasi.
- Migrasi bertahap. Jangan menyentuh semua halaman sekaligus.
- Aturan kode: tanpa komentar, TODO, kode mati, atau `console.log`. Nama deskriptif, tanpa angka ajaib (pakai token). Jalankan formatter dan lint sebelum commit.

## 10. Penerimaan

- Konsistensi token dan komponen, aksesibilitas, responsif, dan kebenaran data diperiksa. Build berhasil saja belum cukup.
- Lebar uji: 320, 375, 768, 1024, 1440px. Tanpa horizontal scroll halaman, tanpa aksi tertutup.
- Uji: keyboard dan fokus, modal, validasi gagal, loading submit, empty state, nama panjang, nominal besar dan negatif.
- Uji gerak: `prefers-reduced-motion` aktif, JS dimatikan, browser tanpa View Transitions, dan tidak ada animasi yang menunda klik.
- Kontras: teks normal 4.5:1, teks besar 3:1, batas kontrol dan fokus 3:1. Ukur pasangan final termasuk hover, overlay, dan teks putih di atas gradien.

## 11. Keputusan implementasi migrasi

- Font Plus Jakarta Sans (subset Latin) dan Phosphor dibundel lokal lewat Vite.
- ID kantong menentukan pasangan palet secara konsisten; warna tidak disimpan sebagai data baru.
- Model belum memiliki target kantong. Bar progres hanya digunakan untuk pembayaran tagihan dan komposisi laporan, bukan target rekaan.
- Token tambahan untuk ukuran ikon/judul, jarak gerak, umur toast, dan idle landing berada di `:root` app.css. Durasi idle 6000ms dan amplitudo 6px mengikuti katalog landing.
- Palet kuning memakai warna warning untuk ikon dan bar data agar tetap terbaca; tab dekoratif tetap kuning.
- Count-up menggunakan overlay visual; node nominal final tidak diubah. Tanpa JS/reduced motion, nominal tampil langsung.
- Chart laporan berupa bar SVG dengan nilai dan ringkasan teks server; tidak membutuhkan Chart.js atau CDN.
- PDF membaca token global dan menyelesaikan CSS variables menjadi nilai literal sebelum Dompdf merender stylesheet cetak lokal. Teks tetap gelap dan status diberi label agar aman untuk grayscale.
- Tanpa JS, dialog ditampilkan sebagai formulir biasa dengan judul/konfirmasi; kontrol yang hanya berfungsi lewat JS disembunyikan.
- Penghapusan dengan JS memakai endpoint dan CSRF yang sama, menunggu konfirmasi sukses server, lalu memudarkan baris asli sebelum memuat ulang. Tanpa JS, form server berjalan seperti biasa.

Keputusan fun modern tahap 1: mobile-first dengan navigasi bawah lima tab dan satu markup bersama untuk desktop rail; modal native menjadi bottom sheet, CTA mengambang memakai safe area. Jahitan hanya pada kantong. Gradien hanya pada ringkasan utama. Radius diperbarui 14/24/28; font dan ikon lokal tetap dipakai.

Keputusan fun modern tahap 2: carousel snap hanya di mobile, grid kantong di tablet/desktop; dashboard bento dengan urutan baca transaksi terbaru sebelum formulir. Odometer menggunakan dua sel digit CSS tanpa mengubah nilai uang. Tilt dibatasi 4 derajat, memakai scheduler rAF bersama; sentuh memakai press.

Keputusan fun modern tahap 3: View Transitions lintas dokumen memakai nama kantong unik dan indikator navigasi bersama; browser tanpa API tetap memakai navigasi/form normal. Tab detail pada desktop menunjukkan kedua panel, mobile berganti dengan keyboard dan crossfade. Toast berhenti saat hover/fokus, bottom sheet mendukung tarik serta tombol/Escape.

Keputusan fun modern tahap 4: ilustrasi SVG satu keluarga (kantong kosong, kantong penuh, koin); konfeti dibatasi 16 partikel sentuh / 24 desktop dan hanya setelah respons sukses transaksi pertama atau seluruh tagihan bulanan lunas. Status terlambat/error/hapus tidak memakai pegas. Tabel transaksi menggunakan satu markup untuk tabel desktop dan kartu mobile. Chart SVG 220px mobile / 280px desktop memiliki legenda lengkap dan nominal final. View Transitions digunakan untuk GET/filter; POST memakai navigasi normal agar redirect server tidak menolak opt-in. VisualViewport mengangkat sheet dan bar aksi saat keyboard mengurangi area layar; viewport-fit dan safe area diaktifkan. CSS Phosphor dihasilkan dari ikon yang dipakai saat build; Tailwind memindai sumber Blade, bukan cache compiled view. Tidak ada dependency runtime baru.

## 12. Fun modern pass

Bagian ini menimpa aturan lama yang bertentangan.

### 12.1 Identitas visual (ciri khas, bukan hiasan)
- **Kantong berjahit**: kartu kantong memiliki garis jahitan putus-putus 1.5px di dalam tepi (inset 8px), warna kategori dengan opacity rendah, plus tab kantong di atas. Ini ciri khas utama; jangan dipakai di kartu non-kantong.
- **Panel ringkasan utama** (satu per halaman): gradien `--color-primary` ke `--color-violet-deep`, teks putih, saldo sangat besar (40-56px desktop), tab kuning, dan satu bentuk kantong besar transparan sebagai latar. Kontras teks putih minimal 4.5:1.
- **Dashboard bento**: grid asimetris dengan ukuran blok berbeda (saldo lebar, pemasukan dan pengeluaran sedang, kantong dan transaksi terbaru berbeda tinggi). Dilarang grid kartu seragam.
- **Stiker status**: badge Lunas, Pemasukan, dan status positif berbentuk stiker (pill dengan border 2px dan rotasi statis -2 derajat). Status Terlambat dan error tidak diputar, tetap lurus dan serius.
- **Tipografi angka**: nominal besar berbobot 800, "Rp" lebih kecil dan redup.
- **Navigasi mobile**: bottom tab bar dengan pill indikator yang meluncur memakai `--ease-spring-real`. Desktop memakai pola indikator yang sama.
- **Ilustrasi**: satu set SVG inline (kantong kosong, kantong penuh, koin) dengan stroke tebal dan palet kantong. Dilarang stock illustration dan emoji.

### 12.2 Animasi lanjutan
| Elemen | Animasi |
| --- | --- |
| Pindah halaman | View Transitions: konten lama memudar dan bergeser 8px, konten baru masuk dengan `--ease-out` (`base`). Header dan navigasi tetap (`view-transition-name`) |
| Kartu kantong ke detail | Shared element: kartu melebar menjadi header detail dengan `view-transition-name` unik per kantong |
| Scroll reveal | CSS scroll-driven (`animation-timeline: view()`) dengan fallback IntersectionObserver kecil |
| Pill navigasi | Meluncur ke item aktif dengan pegas sungguhan, sedikit melar saat bergerak |
| Tombol utama | Hover: kilau tipis menyapu sekali (`clip-path` atau `transform` pada pseudo-element). Ditekan: `scale(.96)` lalu kembali dengan pegas |
| Kartu kantong | Tilt tipis maksimal 4 derajat mengikuti kursor pada perangkat hover, kembali halus saat keluar. Jahitan bergeser sedikit (parallax 2px) |
| Saldo | Odometer (digit bergulir per kolom) memakai overlay; nilai final tetap di DOM |
| Bar dan chart | Tumbuh dengan stagger per batang, nilai muncul setelah batang selesai |
| Tab dan filter | Konten bertukar dengan crossfade dan geser 8px searah tab |
| Daftar transaksi | Baris baru masuk dengan pegas dari atas dan highlight kuning memudar |
| Momen tonggak | Semburan konfeti kecil (maksimal 24 partikel, `--dur-moment`, sekali) HANYA pada: transaksi pertama, semua tagihan bulan ini lunas. Dipicu respons sukses server, tanpa suara, dapat dilewati |
| Toast | Masuk dengan pegas dari tepi, bar waktu tipis menyusut, jeda saat hover |

### 12.3 Kehalusan
- Semua animasi 60fps: hanya `transform`, `opacity`, `clip-path`. Gunakan `will-change` seperlunya dan lepas setelah selesai.
- Satu loop `requestAnimationFrame` untuk semua efek JS. Tanpa `setInterval` untuk animasi.
- Gunakan `@starting-style` dan `transition-behavior: allow-discrete` untuk elemen yang masuk atau keluar dari DOM.
- Efek berat (tilt, konfeti, kilau) dimatikan di perangkat sentuh, `prefers-reduced-motion`, dan hemat daya.
- Dilarang: parallax berat, animasi di tiap elemen, konfeti di luar peristiwa tonggak, suara otomatis, animasi pada status Terlambat atau error.

### 12.4 Bahasa gerak per peristiwa keuangan
- Uang masuk: naik dan hangat (koin jatuh, saldo naik).
- Uang keluar: turun dan tenang (angka berkurang, tanpa dramatisasi).
- Transfer: horizontal dan mulus (koin melengkung antar kartu).
- Bahaya, error, terlambat: statis dan jelas.

## 13. Paritas desktop dan mobile

Bagian ini menimpa aturan lama yang bertentangan. Mobile dan desktop adalah dua komposisi yang sama pentingnya. Mobile bukan versi desktop yang diperkecil.

### 13.1 Prinsip
- Rancang mobile (390px) lebih dulu, lalu perluas ke tablet dan desktop. Setiap halaman wajib punya komposisi mobile yang sengaja dirancang.
- Fungsi, konten, dan kualitas visual setara. Tidak ada fitur atau informasi penting yang hanya ada di satu perangkat.
- Ciri khas (kantong berjahit, tab, stiker, panel gradien, tipografi angka) tampil utuh di mobile.
- Mobile mendapat versi gerak yang disesuaikan, bukan dihilangkan (lihat 13.4).

### 13.2 Komposisi per perangkat
| Elemen | Mobile (< 768px) | Desktop (>= 1024px) |
| --- | --- | --- |
| Navigasi | Bottom tab bar 5 item, pill meluncur, area aman bawah | Sidebar atau header dengan indikator yang sama |
| Aksi utama | Tombol aksi mengambang atau bar aksi lengket di bawah, dalam jangkauan ibu jari | CTA di header halaman |
| Dashboard | Satu kolom berurutan: saldo, pemasukan/pengeluaran (dua kolom kecil), kantong (kartu geser horizontal dengan snap atau satu kolom), transaksi terbaru | Bento asimetris |
| Panel saldo | Lebar penuh, saldo 36-44px, tab kuning dan jahitan tetap terlihat | Saldo hingga 56px |
| Kartu kantong | Satu kolom penuh atau carousel snap, jahitan dan tab utuh | Grid 3-4 kolom dengan tilt |
| Tabel | Daftar kartu ringkas: nominal, tanggal, tipe berlabel, aksi | Tabel penuh |
| Modal dan form | Bottom sheet naik dari bawah, handle kecil, maksimal 90dvh, tombol utama lengket di bawah | Modal tengah maksimal 560px |
| Filter | Chip yang bisa digeser atau bottom sheet filter | Bar filter inline |
| Chart | Tinggi 200-240px, label ringkas, ringkasan teks di bawah | Chart lebar dengan legend samping |
| Toast | Bawah tengah, di atas tab bar | Kanan atas |
| Detail kantong | Header berjahit penuh lebar, tab Riwayat dan Info dengan crossfade | Dua kolom |

### 13.3 Aturan mobile
- Target sentuh minimal 44x44px, jarak antartarget minimal 8px. Aksi utama berada di separuh bawah layar.
- Gunakan safe area: `padding-bottom: env(safe-area-inset-bottom)` pada tab bar dan bar aksi. Gunakan `dvh`, bukan `vh`, untuk tinggi layar.
- Font input minimal 16px agar iOS tidak memperbesar halaman saat fokus. Input nominal memakai `inputmode="numeric"`. Bar aksi lengket tidak boleh tertutup keyboard virtual.
- Konten tidak boleh tertutup tab bar: beri padding bawah sesuai tinggi tab bar.
- Tanpa horizontal scroll halaman. Carousel horizontal hanya di dalam container dengan `scroll-snap`.
- Tanpa efek yang bergantung hover. Setiap efek hover punya padanan sentuh: `:active` memberi `scale(.98)` dan bayangan menyusut.
- Teks dan nominal panjang membungkus tanpa memotong. Layar 320px tetap rapi.
- Orientasi landscape tidak boleh merusak tab bar dan bottom sheet.

### 13.4 Gerak di mobile
- Dipertahankan: count-up atau odometer, pop kantong, pill navigasi berpegas, centang tergambar, highlight baris baru, bar tumbuh, toast, bottom sheet naik dengan pegas, konfeti tonggak (maksimal 16 partikel).
- Diganti: tilt kartu diganti efek tekan `:active`. Kilau tombol dihapus.
- Gestur: bottom sheet bisa ditutup dengan geser ke bawah (progressive enhancement; tombol tutup dan Escape tetap ada).
- Kinerja: target 60fps di ponsel kelas menengah. Batasi elemen beranimasi bersamaan maksimal 8. Jika FPS turun, matikan efek dekoratif lebih dulu.
- Pull-to-refresh dan swipe antarhalaman tidak ditambahkan; jangan bentrok dengan gestur browser.

### 13.5 Kriteria paritas (wajib lulus sebelum tahap dinyatakan selesai)
1. Setiap halaman diperiksa di 320, 390, 768, 1024, 1440px dengan screenshot nyata.
2. Mobile dan desktop sama-sama terasa dirancang: tidak ada ruang kosong janggal, elemen tertumpuk, atau elemen terlalu kecil.
3. Semua aksi utama dapat dijangkau satu tangan di mobile.
4. Ciri khas visual terlihat di semua ukuran.
5. Tidak ada konten, aksi, atau data yang hilang di salah satu perangkat.
6. Uji emulasi perangkat (iPhone SE, iPhone 14, Pixel 7, iPad) dan setidaknya satu ponsel asli bila memungkinkan.
7. Lighthouse mobile Performance minimal 85 dan Accessibility minimal 95 pada Dashboard dan Landing.