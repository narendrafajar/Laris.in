# Laris.in - Sistem Penjualan Titip Jual Berbasis Laravel

**Laris.in** adalah sistem web berbasis Laravel yang dirancang untuk membantu pelaku usaha makanan ringan dalam mengelola penjualan dengan model **titip jual**. Sistem ini memberikan solusi sederhana dan efisien untuk pencatatan titip jual, pengelolaan pengeluaran, serta laporan keuangan secara menyeluruh. Laris.in memungkinkan pemilik usaha untuk memantau penjualan barang, retur, dan beban usaha dengan mudah, serta memperoleh laporan yang jelas untuk membuat keputusan bisnis yang lebih baik.

## Fitur Utama

1. **Manajemen Titip Jual**
   - Pencatatan barang yang dititipkan ke toko/warung.
   - Pengelolaan transaksi titip jual, termasuk jumlah barang yang terjual dan retur.
   - Menghitung pendapatan bersih setelah penjualan dan retur.

2. **Pencatatan Pengeluaran**
   - Mencatat pengeluaran usaha seperti pembelian bahan baku, biaya operasional, dan transportasi.
   - Kategori pengeluaran terintegrasi dengan **Chart of Accounts (COA)** untuk laporan keuangan yang lebih jelas.

3. **Manajemen Barang Retur**
   - Barang yang tidak laku bisa dikembalikan ke stok, diolah menjadi produk baru, atau dihitung sebagai kerugian.
   - Sistem secara otomatis menghitung kerugian atau pendapatan tambahan berdasarkan keputusan pengolahan retur.

4. **Laporan Keuangan Lengkap**
   - **Laporan Laba Rugi**: Menampilkan pendapatan, pengeluaran, dan laba bersih dalam periode tertentu.
   - **Neraca Keuangan**: Menampilkan aset, liabilitas, dan ekuitas.
   - **Laporan Penjualan**: Detail transaksi titip jual, termasuk barang yang terjual dan yang dikembalikan.
   
5. **Multi-User Support**
   - Fitur pengguna dengan hak akses berbeda, seperti pemilik usaha atau karyawan, untuk mengelola data dan transaksi.
   
6. **Ekspor Laporan**
   - Laporan dapat diekspor dalam format PDF atau Excel untuk memudahkan analisis lebih lanjut atau arsip.

## Teknologi yang Digunakan

- **Framework**: Laravel 10
- **Database**: MySQL
- **Frontend**: Blade Templating Engine
- **Library Tambahan**:
  - **DataTables** untuk pengelolaan tabel dinamis.
  - **DomPDF** untuk mengekspor laporan ke PDF.

## Cara Instalasi

### Prasyarat
- PHP >= 8.0
- Composer
- MySQL

### Langkah-langkah Instalasi

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/username/laris.in.git
   cd laris.in
2. **Instal Dependensi:**
   ```bash
   Instal dependensi PHP menggunakan Composer:
   composer install
   npm install && npm run dev
3. **Konfigurasi File .env**
   ````bash
   Salin file .env.example menjadi .env
   cp .env.example .env
   Set konfigurasi database di file .env.
4. **Generate Kunci Aplikasi:**
   ````bash
   php artisan key:generate
5. **Migrasi Database:**
   ````bash
   php artisan migrate --seed

## Penggunaan
Setelah berhasil menginstal dan menjalankan aplikasi, Anda dapat:

- Login dengan akun admin (akun pertama yang dibuat).
- Menambahkan data barang, toko/warung, dan mencatat transaksi titip jual.
- Mencatat pengeluaran dan barang retur.
- Mengakses laporan keuangan untuk mendapatkan gambaran keseluruhan kinerja usaha.

## Kontribusi
1. **Langkah-langkah untuk Berkontribusi:**
   ```bash
   Fork repositori ini.
   Buat branch baru untuk fitur atau perbaikan yang Anda buat.
   Kirim pull request dengan penjelasan tentang perubahan yang dilakukan.

## Lisensi
Proyek ini dilisensikan di bawah **MIT License.**

## Kontak
Jika Anda memiliki pertanyaan atau saran, silakan hubungi kami di email: fajar@rndweb.my.id

---

Deskripsi ini sudah lengkap untuk kebutuhan proyek **Laris.in** Anda. Anda hanya perlu mengganti bagian `username` pada URL repositori GitHub dan menyesuaikan jika diperlukan. Selamat mencoba! 😊

