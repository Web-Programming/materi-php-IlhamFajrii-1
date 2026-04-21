<?php
require("Mobil.php");
use Kendaraan\Mobil;

// instansiasi object
$mobil_ahmad = new Mobil();
// set property
$mobil_ahmad->warna = "Hitam";
$mobil_ahmad->merk = "Toyota";

// tampilkan property
echo "Mobil Ahmad";
echo "<br>Warna : ". $mobil_ahmad->warna;
echo "<br>Merk : ". $mobil_ahmad->merk;

// tampilkan method
echo $mobil_ahmad->maju();
echo "<br>";
echo $mobil_ahmad->berhenti();