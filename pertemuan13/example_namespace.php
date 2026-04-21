<?php
/**
 * Contoh penggunaan Namespace pada Class Kendaraan
 */

// Import class dengan use statement
use App\\Kendaraan\\Kendaraan as Kendaraan;

$kendaraan_ahmad = new Kendaraan();
$kendaraan_anton = new Kendaraan();

$kendaraan_ahmad->warna = "Hitam";
$kendaraan_ahmad->merk = "Toyota";

echo "Kendaraan Ahmad (menggunakan namespace):<br>";
echo "Warna: " . $kendaraan_ahmad->warna . "<br>";
echo "Merk: " . $kendaraan_ahmad->merk . "<br>";
echo $kendaraan_ahmad->maju() . "<br>";
echo $kendaraan_ahmad->berhenti() . "<br>";

echo "<hr>";
echo "Kendaraan Anton:<br>";
echo "Warna: " . $kendaraan_anton->warna . "<br>"; // Belum diset
?>

