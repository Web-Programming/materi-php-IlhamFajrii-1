<?php
// proses_keuangan.php (Versi Aman)

if (isset($_POST['simpan'])) {
    
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    
    // 1. Mencegah XSS (Cross-Site Scripting) menggunakan htmlspecialchars
    // Mengubah karakter khusus menjadi entitas HTML
    $keterangan = htmlspecialchars($_POST['keterangan']);

    // 2. Validasi nominal di sisi server (Backend)
    if ($nominal <= 0) {
        // Hentikan eksekusi dan berikan pesan error
        die("Error: Nominal transaksi harus lebih besar dari Rp 0.");
    }

    echo "<h3>Ringkasan Transaksi Tersimpan:</h3>";
    echo "Tanggal: " . $tanggal . "<br>";
    
    // Memberikan warna teks berdasarkan jenis transaksi (opsional sebagai pemanis)
    if ($jenis == "Pemasukan") {
        echo "Jenis: <span style='color: green;'>$jenis</span><br>";
    } else {
        echo "Jenis: <span style='color: red;'>$jenis</span><br>";
    }
    
    echo "Nominal: Rp " . number_format($nominal, 0, ',', '.') . "<br>";
    echo "Keterangan: " . $keterangan . "<br>";
    
} else {
    echo "Akses ditolak. Silakan isi form terlebih dahulu.";
}
?>