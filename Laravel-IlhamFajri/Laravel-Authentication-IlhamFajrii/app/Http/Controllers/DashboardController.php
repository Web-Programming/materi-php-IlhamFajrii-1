<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total barang
        $totalBarang = Product::count();
        
        // Barang tersedia
        $barangTersedia = Product::where('status', 'tersedia')->count();
        
        // Barang habis
        $barangHabis = Product::where('status', 'habis')->count();
        
        // Total nilai stok (price * stock untuk setiap produk, kemudian dijumlahkan)
        $totalNilaiStok = Product::selectRaw('SUM(price * stock) as total')
                                 ->value('total') ?? 0;
        
        // Get user name
        $userName = auth()->user()->name;
        
        // Ambil beberapa produk terbaru untuk ditampilkan di dashboard
        $produkTerbaru = Product::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalBarang',
            'barangTersedia',
            'barangHabis',
            'totalNilaiStok',
            'userName',
            'produkTerbaru'
        ));
    }
}
