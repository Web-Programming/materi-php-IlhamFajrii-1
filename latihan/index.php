<?php
require_once "app/Item.php";
require_once "produk/Item.php";

// Gunakan alias supaya tidak bentrok
use App\Item as AppItem;
use Produk\Item as ProdukItem;

// Membuat instance
$item1 = new AppItem("Service A");
$item2 = new ProdukItem("Produk B");

// Menampilkan hasil
echo $item1->info();
echo "<br>";
echo $item2->info();