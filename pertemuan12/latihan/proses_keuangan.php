<?php
// proses_keuangan.php

// 1. Mengecek apakah tombol submit dengan name="simpan" sudah ditekan
if (isset($_POST['simpan'])) {
    
    // 2. Menangkap data menggunakan superglobal $_POST
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    // 3. Menampilkan ringkasan data
    echo "<h3>Ringkasan Transaksi Tersimpan:</h3>";
    echo "Tanggal: " . $tanggal . "<br>";
    echo "Jenis: " . $jenis . "<br>";
    
    // Menggunakan number_format agar tampilan angka lebih enak dibaca (opsional)
    echo "Nominal: Rp " . number_format($nominal, 0, ',', '.') . "<br>";
    echo "Keterangan: " . $keterangan . "<br>";
    
} else {
    // Jika file ini diakses langsung tanpa lewat form
    echo "Akses ditolak. Silakan isi form terlebih dahulu.";
}
?>