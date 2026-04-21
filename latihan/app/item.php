<?php
namespace App;

class Item {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function info() {
        return "Ini adalah item dari namespace App dengan nama: " . $this->nama;
    }
}