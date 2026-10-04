# Dompet Rantau

**Aplikasi pengelolaan keuangan pribadi dengan peluang pengembangan untuk program kesejahteraan finansial organisasi.**

Dompet Rantau membantu pengguna mencatat pemasukan dan pengeluaran, membagi dana ke dalam kantong, mengelola tagihan rutin, serta mengevaluasi arus kas melalui laporan. Dirancang untuk anak rantau, mahasiswa, dan pekerja, aplikasi ini menyajikan aktivitas keuangan sehari-hari dalam antarmuka berbahasa Indonesia yang responsif.

## Nilai produk

- **Pencatatan terpusat:** transaksi, kantong, dan tagihan tersedia dalam satu aplikasi.
- **Alokasi dana terstruktur:** kantong membantu pengguna memisahkan dana sesuai kebutuhan.
- **Visibilitas arus kas:** ringkasan dan laporan periode membantu pengguna meninjau pemasukan serta pengeluaran.
- **Arsip praktis:** laporan dapat diunduh sebagai PDF untuk dokumentasi pribadi.

## Konteks B2B dan peluang kemitraan

Dalam skenario **Business-to-Business (B2B)**, Dompet Rantau berpotensi dikembangkan sebagai sarana pendamping program literasi dan kesejahteraan finansial. Organisasi menjadi mitra penyedia program, sementara karyawan, mahasiswa, atau anggota komunitas menggunakan aplikasi untuk mengelola keuangan pribadi.

| Calon mitra | Skenario pemanfaatan |
| --- | --- |
| Perusahaan dan tim HR | Pendamping program kesejahteraan finansial karyawan, termasuk pekerja yang tinggal jauh dari daerah asal. |
| Perguruan tinggi dan lembaga pendidikan | Pendamping edukasi pengelolaan uang saku dan biaya hidup mahasiswa. |
| Komunitas dan organisasi pendamping perantau | Sarana praktik pencatatan keuangan dalam program pembinaan anggota. |

Implementasi dalam repositori ini masih berorientasi pada **akun individu**. Skenario kemitraan di atas merupakan arah pengembangan, bukan fitur B2B yang sudah tersedia. Workspace organisasi, pengelolaan anggota, role admin, dashboard agregat, SSO, dan langganan perusahaan belum diimplementasikan.

Pengembangan B2B perlu mencakup pemisahan data antarorganisasi, pengaturan hak akses, dan persetujuan pengguna sebelum membagikan informasi keuangan kepada mitra. Model komersial seperti lisensi organisasi atau langganan per pengguna dapat dievaluasi setelah kebutuhan mitra tervalidasi.

## Fitur yang tersedia

| Modul | Kemampuan |
| --- | --- |
| Dashboard | Ringkasan pemasukan, pengeluaran, saldo, kantong, dan transaksi terbaru. |
| Kantong | Membuat dan menghapus kantong, melihat saldo serta transaksi per kantong. |
| Transaksi | Mencatat pemasukan dan pengeluaran, melihat riwayat, serta menghapus catatan transaksi. |
| Transfer antarkantong | Memindahkan alokasi dana melalui pencatatan transaksi pada kantong sumber dan tujuan. |
| Tagihan | Mengelola tagihan mingguan atau bulanan, mencatat pembayaran individual maupun beberapa tagihan sekaligus. |
| Laporan | Memfilter periode, melihat arus kas dan distribusi pengeluaran per kategori, serta mengekspor PDF. |
| Akun dan profil | Registrasi, login, logout, reset password, serta pengelolaan profil dan password. |

Transfer dan pembayaran tagihan merupakan **pencatatan internal aplikasi**. Repositori ini belum menyediakan integrasi bank, dompet digital, atau payment gateway untuk memindahkan uang maupun membayar penyedia layanan secara langsung.

## Tech stack

Teknologi berikut mengacu pada manifest dan konfigurasi repositori.

| Lapisan | Teknologi | Peran |
| --- | --- | --- |
| Backend | PHP 8.2+, Laravel 12 | Routing, validasi, logika aplikasi, dan akses data melalui Eloquent ORM. |
| Rendering | Blade | Template halaman dan komponen antarmuka di sisi server. |
| Styling | Tailwind CSS 3, PostCSS, Autoprefixer | Layout responsif dan styling berbasis token desain. |
| Interaksi | Alpine.js 3, Axios | Interaksi antarmuka dan utilitas permintaan HTTP. |
| Build assets | Vite 7, Laravel Vite Plugin | Pengembangan dan bundling CSS, JavaScript, font, serta ikon. |
| Autentikasi | Laravel Breeze | Fondasi alur autentikasi dan pengelolaan akun. |
| Database | SQLite secara default | Penyimpanan lokal sesuai `.env.example`; koneksi lain dapat dikonfigurasi melalui Laravel. |
| Ekspor | Laravel Dompdf 3 | Pembuatan laporan PDF. |
| Identitas visual | Plus Jakarta Sans, Phosphor Icons | Font dan ikon yang dibundel lokal. |
| Kualitas kode | PHPUnit 11, Laravel Pint | Pengujian aplikasi dan format kode PHP. |

## Arsitektur dan struktur repositori

Dompet Rantau menggunakan arsitektur monolit berbasis Laravel MVC. Permintaan web diproses oleh route dan controller, data disimpan melalui model Eloquent, lalu halaman dirender menggunakan Blade. Alpine.js menangani interaksi antarmuka tanpa memerlukan aplikasi frontend terpisah.

```text
app/Http/Controllers/       Controller keuangan, tagihan, laporan, dan akun
app/Models/                 Model User, Category, Transaction, dan Bill
database/migrations/        Definisi struktur database
resources/views/            Halaman Blade, layout, dan komponen bersama
resources/css/app.css       Style dan token global
resources/js/app.js         Entry point JavaScript
routes/web.php              Rute aplikasi
routes/auth.php             Rute autentikasi
tests/                      Pengujian unit dan fitur
docs/ui-progress.md         Catatan progres UI
```

## Menjalankan secara lokal

### Prasyarat

- PHP 8.2 atau lebih baru beserta ekstensi yang diperlukan Laravel dan driver SQLite.
- Composer 2.
- Node.js dan npm yang memenuhi persyaratan versi pada paket Vite dalam `package-lock.json`.
- Git untuk mengambil repositori.

### Instalasi

Jalankan perintah berikut dari direktori proyek pada checkout baru:

```bash
composer install
cp .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate
npm ci
npm run build
```

Sesuaikan `APP_NAME`, `APP_URL`, dan koneksi database pada `.env` untuk lingkungan lokal. Konfigurasi bawaan menggunakan SQLite, sedangkan session, cache, dan queue menggunakan database. Pada instalasi yang sudah berjalan, pertahankan `.env` dan application key yang ada.

Untuk menjalankan server aplikasi, Vite, queue listener, dan pemantauan log secara bersamaan:

```bash
composer run dev
```

Buka `http://localhost:8000`, lalu buat akun melalui halaman registrasi. Mailer bawaan menggunakan `log`; pengiriman email reset password ke inbox memerlukan konfigurasi layanan email.

## Verifikasi pengembangan

```bash
php artisan test
vendor/bin/pint --dirty
npm run build
git diff --check
```

Konfigurasi [phpunit.xml](phpunit.xml) menggunakan SQLite in-memory untuk pengujian. Pastikan konfigurasi pengujian tetap terisolasi dari database pengguna sebelum menjalankan test.

Build assets memverifikasi proses bundling; pemeriksaan visual, keyboard, dan perilaku mobile tetap perlu dilakukan pada halaman yang berubah.

`AGENTS.md` dan `design.md` merupakan dokumen kerja lokal yang diabaikan Git dan tidak disertakan dalam checkout repositori.

## Batas implementasi

- Aplikasi berfokus pada pencatatan dan pengelolaan keuangan pribadi; belum menyediakan pembukuan bisnis, payroll, perpajakan, atau rekonsiliasi bank otomatis.
- Autentikasi berbasis session, validasi server, dan proteksi CSRF mengikuti mekanisme Laravel. Kesiapan untuk penggunaan organisasi tetap memerlukan peninjauan keamanan dan otorisasi setiap alur data.
- Penggunaan produksi memerlukan konfigurasi lingkungan, layanan email, backup, pemantauan, dan pengelolaan akses yang sesuai.

## Lisensi

Manifest `composer.json` mencantumkan MIT. Repositori saat ini belum menyertakan berkas `LICENSE`; ketentuan distribusi perlu dilengkapi sebelum publikasi atau penggunaan komersial.
