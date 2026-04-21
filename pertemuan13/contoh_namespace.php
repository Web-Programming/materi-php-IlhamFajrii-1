<?php
/**
 * Contoh penggunaan Namespace pada Class Kendaraan
 */

// Cara 1: Full qualified name
$kendaraan1 = new App\Kendaraan\Kendaraan();
$kendaraan1->warna = "Merah";
$kendaraan1->merk = "Honda";
echo "Kendaraan 1 (Full FQCN): " . $kendaraan1->merk . " (" . $kendaraan1->warna . ")<br>";
echo $kendaraan1->maju() . "<br>";
echo $kendaraan1->berhenti() . "<hr>";

// Cara 2: Menggunakan 'use' statement
use App\Kendaraan\Kendaraan;

$kendaraan2 = new Kendaraan();
$kendaraan2->warna = "Hitam";
$kendaraan2->merk = "Toyota";

echo "Kendaraan 2 (dengan use): " . $kendaraan2->merk . " (" . $kendaraan2->warna . ")<br>";
echo $kendaraan2->maju() . "<br>";
echo $kendaraan2->berhenti() . "<hr>";

// Cara 3: Alias
use App\Kendaraan\Kendaraan as Vehicle;

$kendaraan3 = new Vehicle();
$kendaraan3->warna = "Biru";
$kendaraan3->merk = "Suzuki";

echo "Kendaraan 3 (alias Vehicle): " . $kendaraan3->merk . " (" . $kendaraan3->warna . ")<br>";
echo $kendaraan3->maju() . "<br>";
echo $kendaraan3->berhenti() . "<br>";
?>

