<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get search query
        $search = $request->get('search');
        
        // Total barang (berdasarkan search jika ada)
        $query = Product::query();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
        $totalBarang = $query->count();
        
        // Barang tersedia
        $barangTersedia = Product::where('status', 'tersedia')
            ->when($search, function($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->count();
        
        // Barang habis
        $barangHabis = Product::where('status', 'habis')
            ->when($search, function($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->count();
        
        // Total nilai stok (price * stock untuk setiap produk, kemudian dijumlahkan)
        $totalNilaiStok = Product::selectRaw('SUM(price * stock) as total')
            ->when($search, function($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->value('total') ?? 0;
        
        // Get user name
        $userName = Auth::user()->name ?? 'User';
        
        // Ambil beberapa produk terbaru untuk ditampilkan di dashboard (dengan filter search)
        $produkTerbaru = Product::latest()
            ->when($search, function($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalBarang',
            'barangTersedia',
            'barangHabis',
            'totalNilaiStok',
            'userName',
            'produkTerbaru',
            'search'
        ));
    }
}
