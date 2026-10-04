# Design system: Dompet Rantau

Sumber aturan visual dan interaksi untuk seluruh aplikasi: landing, autentikasi, dashboard, kantong, transaksi, tagihan, laporan, profil, modal, dan komponen bersama.

Tema: **fun, ramah, rapi**, seperti buku catatan keuangan anak rantau dengan kantong warna-warni. Rapi untuk data, hidup untuk interaksi.

Status: panduan target. UI lama belum otomatis memenuhi aturan ini. Jangan menganggap semua token sudah ada di kode.

## 0. Ringkasan (baca ini dulu)

1. Angka dan tindakan utama terbaca lebih dulu daripada dekorasi.
2. Permukaan terang dan solid. Satu panel ringkasan berwarna per halaman. Tabel dan formulir tetap tenang.
3. Keseruan datang dari: warna kantong, tab kantong khas, ikon Phosphor, microcopy ramah, dan **animasi yang konsisten** (bagian 7).
4. Brand fuchsia, bahaya merah. Keduanya tidak boleh tertukar.
5. Satu bahasa gerak: token durasi dan easing yang sama di semua animasi. Hanya `transform` dan `opacity`.
6. Hormati `prefers-reduced-motion`. Animasi tidak pernah menunda atau menghalangi tindakan pengguna.
7. Kode tanpa komentar, TODO, atau `console.log`.
8. Dark mode: tidak didukung. Jangan menambahkannya.

## 1. Prinsip

- Komponen dengan fungsi sama wajib sama bentuk, warna, label, dan perilaku di semua halaman.
- Kesalahan, tagihan terlambat, dan tindakan hapus harus jelas dan serius. Tanpa candaan yang menyalahkan pengguna dan tanpa animasi main-main.
- Animasi menjelaskan perubahan (uang masuk, uang pindah, tagihan lunas), bukan sekadar menghias.
- Jangan menambah dekorasi pada setiap elemen.

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

### Palet kategori kantong

Delapan pasangan tetap. Kantong baru memilih dari daftar ini, tidak boleh membuat warna sendiri. Teks di atas warna soft selalu `--color-text`. Warna kuat dipakai untuk ikon, tab kantong, dan bar progres.

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
- Saldo utama: 32px mobile, 40px desktop, weight 800. Nominal membungkus tanpa keluar dari kartu.
- Sentence case. Hindari label huruf kapital panjang.
- Nominal: `font-variant-numeric: tabular-nums`, rata kanan di tabel, rata kiri di kartu ringkasan.
- Format mata uang: `Rp 1.250.000`. Negatif: `-Rp 50.000` (tanda minus di depan "Rp"). Jangan membulatkan nilai tersimpan demi tampilan.
- Tanggal UI: `4 Okt 2026`. Gunakan zona waktu aplikasi, jangan hardcode zona lain di view.

## 4. Spacing, bentuk, layout

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `--space-1` sampai `--space-8` | 4, 8, 12, 16, 20, 24, 32, 48px | Skala spacing |
| `--radius-control` | 12px | Input dan tombol |
| `--radius-card` | 20px | Kartu dan panel |
| `--radius-modal` | 24px | Modal dan panel utama |
| `--radius-pill` | 9999px | Badge dan avatar saja |
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
- **Tab kantong**: elemen khas berupa tab kecil di tepi atas kartu, dibuat dengan `clip-path` atau SVG inline, warna kuat dari palet kategori, `aria-hidden="true"`. Kartu ringkasan utama memakai tab kuning.
- Kartu biasa: surface putih, border tipis. Tanpa glow dan gradient.
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
- Tone bersahabat dan mendukung. Jangan menghakimi kebiasaan belanja. Tanpa istilah teknis backend.

## 7. Motion system

Prinsip: satu bahasa gerak, banyak ekspresi. Gerak harus terasa **hidup namun terkendali**: cepat, lembut, tidak pernah menghalangi.

### 7.1 Token gerak (di `resources/css/app.css`)

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `--dur-fast` | 150ms | Hover, warna, press |
| `--dur-base` | 220ms | Dropdown, modal, toast |
| `--dur-slow` | 420ms | Reveal kartu, progres, count-up |
| `--dur-moment` | 700ms | Momen perayaan (maksimal, sekali) |
| `--ease-out` | `cubic-bezier(.22, 1, .36, 1)` | Masuk dan reveal |
| `--ease-in` | `cubic-bezier(.4, 0, 1, 1)` | Keluar |
| `--ease-spring` | `cubic-bezier(.34, 1.4, .64, 1)` | Pop kecil (badge, centang) |
| `--stagger` | 60ms | Jeda antaritem, maksimal 8 item bergelombang |

Semua animasi wajib memakai token ini, tanpa angka acak di view atau komponen.

### 7.2 Aturan teknis
- Animasikan hanya `transform` dan `opacity`. Pengecualian: `stroke-dashoffset` pada SVG dan `clip-path` pada tab kantong.
- Utamakan CSS (transition, keyframes, `@starting-style`). JavaScript kecil dan modular untuk count-up dan orkestrasi. Gunakan Alpine bila sudah ada di proyek. Jangan menambah library animasi tanpa alasan tertulis.
- Setiap animasi **sekali jalan** (one-shot) saat masuk atau saat terjadi peristiwa. Tidak ada loop tanpa henti, pulse terus-menerus, atau confetti otomatis.
- Pengecualian satu-satunya: ilustrasi landing boleh punya gerak idle halus, berhenti saat di luar viewport.
- Animasi tidak boleh menunda tindakan. Elemen interaktif bisa diklik sejak frame pertama.
- Nilai uang di DOM selalu nilai akhir yang benar. Count-up hanya efek visual; pembaca layar dan salin teks mendapat nilai akhir (`aria-label` atau teks tersembunyi).
- Reveal tidak menyembunyikan konten dengan CSS sebelum JS siap. Tanpa JS, semua tampil.
- Tidak ada kedipan lebih dari 3 kali per detik.

### 7.3 Katalog animasi (pakai ini, jangan buat gaya baru)

**Umum**
| Elemen | Animasi |
| --- | --- |
| Tombol | Hover naik 1px dan warna berubah (`fast`). Ditekan: `scale(.97)` (`fast`). Loading: spinner kecil menggantikan ikon, label berubah |
| Kartu interaktif | Hover naik maksimal 2px dan bayangan menguat (`fast`) |
| Tautan navigasi | Indikator aktif meluncur ke item baru (`base`, `ease-out`) |
| Halaman masuk | Judul lalu konten muncul `opacity` + naik 8px, stagger antarblok (`slow`). Hanya saat muat halaman pertama, bukan setiap interaksi |
| Daftar dan grid | Item masuk bergelombang dengan `--stagger`, maksimal 8 item pertama; sisanya langsung tampil |
| Skeleton loading | Shimmer halus satu arah, hanya selama memuat. Tanpa pergeseran layout |
| Modal | Overlay fade, panel naik 12px + fade (`base`). Keluar `ease-in` lebih cepat |
| Dropdown | Fade + turun 4px (`base`) |
| Toast | Meluncur masuk dari tepi + fade (`base`), keluar fade |
| Input fokus | Border dan ring berubah warna (`fast`) |
| Error field | Pesan error muncul fade + turun 4px. Field bergeser horizontal kecil satu kali (maksimal 4px, 2 siklus). Tidak berkedip |

**Khas keuangan (momen fun)**
| Peristiwa | Animasi |
| --- | --- |
| Saldo dan ringkasan | Count-up dari nilai sebelumnya ke nilai baru (`slow`). Pertama kali halaman dibuka: dari 0 |
| Kantong dibuat atau kartu baru muncul | Kartu pop masuk dengan `ease-spring`, tab kantong terbuka dengan `clip-path` |
| Hover kartu kantong | Tab kantong naik 2px dan sedikit melebar. Ikon kategori miring 4 derajat sekali |
| Progres target kantong | Bar terisi dari 0 ke nilai (`slow`, `ease-out`) saat masuk viewport |
| Transaksi berhasil disimpan | Ikon centang tergambar (SVG `stroke-dashoffset`, `base`), toast sukses. Baris baru di riwayat masuk dengan highlight kuning lembut yang memudar |
| Pemasukan | Koin kecil jatuh dari atas ke kantong tujuan (satu kali, `moment`) |
| Transfer dana | Satu koin bergerak melengkung dari kantong asal ke tujuan, kedua saldo count-up. Hanya bila kedua kartu terlihat di layar |
| Tagihan dibayar | Badge berubah ke "Lunas" dengan pop `ease-spring`, stempel centang hijau muncul sekali |
| Tagihan terlambat | Tanpa animasi perayaan atau main-main. Badge statis, serius, berikut label teks |
| Hapus item | Baris mengecil dan memudar (`base`), daftar di bawahnya naik halus. Tanpa efek dramatis |
| Empty state | Ilustrasi kantong kosong masuk fade + naik sekali. Tombol aksi jelas |
| Landing | Preview produk atau kantong bergerak idle halus (naik-turun maksimal 6px, 6 detik, easing lembut). Kartu fitur reveal saat scroll dengan stagger |

### 7.4 Reduced motion dan perangkat
- `prefers-reduced-motion: reduce`: hapus semua translate, scale, stagger, count-up, koin, dan idle. Sisakan perubahan opacity dan warna instan atau sangat singkat. Konten tetap tampil penuh.
- Perangkat sentuh: tidak ada animasi yang bergantung hover.
- Jika FPS turun atau perangkat lemah, momen perayaan (koin, stempel) dilewati. Fungsi tetap utuh.
- Satu komponen animasi untuk satu peristiwa. Jangan menduplikasi varian di halaman berbeda.

## 8. Penerapan per halaman

| Area | Aturan khusus |
| --- | --- |
| Landing | Satu ilustrasi kantong atau preview produk sebagai fokus. CTA "Mulai catat keuangan". Tanpa testimoni atau angka rekaan. Gerak: idle ilustrasi + reveal scroll |
| Auth | Layout guest, token sama, panel form sederhana, error dekat field. Gerak minimal: panel masuk, error field |
| Dashboard | Saldo, lalu pemasukan/pengeluaran, kantong, transaksi terbaru. Count-up saldo, grid kantong bergelombang |
| Kantong | Kartu dengan struktur sama dan tab kantong. Detail: nama, saldo, tindakan, riwayat. Bar progres terisi |
| Transaksi | Tipe berlabel eksplisit. Filter dan format nominal sama di dashboard, riwayat, dan detail. Animasi centang dan highlight baris baru |
| Tagihan | Nominal, jatuh tempo, status, aksi bayar. Terlambat tidak hanya warna. Stempel Lunas |
| Laporan | Periode dan filter jelas, chart dengan angka. Chart tumbuh saat masuk viewport. Ekspor mempertahankan arti status |
| PDF laporan | Latar putih, font yang didukung renderer, tabel tidak terpotong, kontras aman di grayscale. Tanpa motion dan tanpa CDN |
| Profil | Komponen bersama. Hapus akun dipisahkan dari pengaturan biasa |

## 9. Implementasi

- Token global di `resources/css/app.css`; pemetaan utility di `tailwind.config.js`. Jangan ubah major version Tailwind.
- Komponen Blade di `resources/views/components/` untuk tombol, field, input nominal, modal, status, kartu kantong, dan toast.
- Utilitas animasi di modul JS kecil terpisah per fitur (count-up, reveal, koin). Satu file satu tanggung jawab.
- Layout app dan guest berbagi token. Periksa `layouts/app.blade.php` dan `layouts/navigation.blade.php` agar tidak ada dua sistem navigasi.
- Migrasi bertahap. Urutan: token dan komponen dasar, lalu Dashboard, Kantong, Transaksi, Tagihan, Laporan, Auth, Landing, Profil. Jangan menyentuh semua halaman sekaligus.
- Aturan kode: tanpa komentar, TODO, kode mati, atau `console.log`. Nama deskriptif, tanpa angka ajaib (pakai token). Jalankan formatter dan lint sebelum commit.

## 10. Penerimaan

- Konsistensi token dan komponen, aksesibilitas, responsif, dan kebenaran data diperiksa. Build berhasil saja belum cukup.
- Lebar uji: 320, 375, 768, 1024, 1440px. Tanpa horizontal scroll halaman, tanpa aksi tertutup.
- Uji: keyboard dan fokus, modal, validasi gagal, loading submit, empty state, nama panjang, nominal besar dan negatif.
- Uji gerak: `prefers-reduced-motion` aktif, JS dimatikan, dan tidak ada animasi yang menunda klik.
- Kontras: teks normal 4.5:1, teks besar 3:1, batas kontrol dan fokus 3:1. Ukur pasangan final termasuk hover dan overlay.