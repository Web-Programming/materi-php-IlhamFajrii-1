# Aplikasi Pencatatan Keuangan Sederhana
## Membuat Form Input
Skenario: Anda diminta membuat halaman untuk menambahkan catatan keuangan baru.
Tugas: Buatlah sebuah form HTML sederhana yang menggunakan metode POST untuk mengirimkan data ke file bernama proses_keuangan.php. Form tersebut harus memiliki field berikut:

1. Tanggal Transaksi (tipe input yang sesuai untuk tanggal).
2. Jenis Transaksi (pilihan dropdown/select yang berisi "Pemasukan" dan "Pengeluaran").
3. Nominal (tipe input untuk angka).
4. Keterangan (tipe input teks).
5. Tombol Submit dengan tulisan "Simpan Data" dan name="simpan".


## Processing Form Data
Buatlah script PHP di file proses_keuangan.php. Script ini harus:

1. Mengecek apakah form benar-benar disubmit menggunakan tombol "Simpan Data".
2. Menangkap semua data yang dikirimkan dari form.
3. Menampilkan ringkasan data tersebut kembali ke layar dengan format yang rapi.

## Keamanan dan Validasi
Skenario: Pengguna bisa saja tidak sengaja (atau sengaja) memasukkan script berbahaya ke dalam input "Keterangan" (Serangan XSS), atau memasukkan nominal negatif (meskipun sudah dicegah di HTML, kita harus mengeceknya di PHP).

Modifikasi kode PHP pada file proses_keuangan.php untuk menambahkan:
1. Validasi keamanan pada variabel $keterangan agar tag HTML atau script tidak dieksekusi oleh browser.
2. Logika yang memastikan $nominal harus lebih besar dari 0. Jika kurang dari atau sama dengan 0, tampilkan pesan error dan hentikan proses.