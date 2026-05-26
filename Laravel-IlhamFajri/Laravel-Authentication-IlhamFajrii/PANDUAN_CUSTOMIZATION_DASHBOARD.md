# 🎨 PANDUAN CUSTOMIZATION - Admin Dashboard

Panduan lengkap untuk mengcustomize Admin Dashboard sesuai kebutuhan Anda.

---

## 🎨 1. Mengubah Warna Kartu Statistik

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Lokasi CSS (line ~150)
```css
.stat-card.blue::before {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
}

.stat-card.green::before {
    background: linear-gradient(90deg, #10b981 0%, #059669 100%);
}

.stat-card.red::before {
    background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
}

.stat-card.orange::before {
    background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
}
```

### Contoh Perubahan
```css
/* Mengubah warna biru ke warna custom */
.stat-card.blue::before {
    background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%);
}

/* Mengubah warna hijau */
.stat-card.green::before {
    background: linear-gradient(90deg, #14b8a6 0%, #0d9488 100%);
}
```

---

## 📋 2. Menambah Menu Baru di Sidebar

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Lokasi HTML (di dalam `<ul class="sidebar-menu">`)
```blade
<li>
    <a href="/admin/menu-baru" class="@if(Route::currentRouteName() == 'admin.menu-baru') active @endif">
        <i class="bi bi-icon-name"></i>
        <span>Menu Baru</span>
    </a>
</li>
```

### Contoh Lengkap
```blade
<!-- Tambahkan sebelum tombol Logout -->
<li>
    <a href="/admin/stok" class="@if(Route::currentRouteName() == 'admin.stok') active @endif">
        <i class="bi bi-graph-up"></i>
        <span>Monitoring Stok</span>
    </a>
</li>

<li>
    <a href="/admin/supplier" class="@if(Route::currentRouteName() == 'admin.supplier') active @endif">
        <i class="bi bi-truck"></i>
        <span>Data Supplier</span>
    </a>
</li>
```

### Icon Tersedia
Gunakan dari [Bootstrap Icons](https://icons.getbootstrap.com/)
- `bi-speedometer2` → Dashboard
- `bi-cart3` → Pesanan
- `bi-box` → Barang
- `bi-plus-circle` → Tambah
- `bi-file-earmark-pdf` → Laporan
- `bi-graph-up` → Statistik
- `bi-truck` → Supplier
- `bi-settings` → Settings

---

## 📊 3. Menambah Kartu Statistik Baru

### Edit File
```
resources/views/admin/dashboard.blade.php
```

### Contoh Template
```blade
<!-- Tambahkan setelah kartu "Total Nilai Stok" -->
<div class="stat-card purple">
    <div class="stat-icon">
        <i class="bi bi-graph-up"></i>
    </div>
    <div class="stat-label">Penjualan Hari Ini</div>
    <div class="stat-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</div>
    <div class="stat-change">↑ 12% dari kemarin</div>
</div>
```

### Update CSS Layout
Edit `resources/views/layouts/admin.blade.php` untuk menambah 5 kartu:
```css
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}
```

Akan otomatis menyesuaikan ke layout 5 kolom jika ada 5 kartu.

### Tambah Warna Baru
```css
.stat-card.purple::before {
    background: linear-gradient(90deg, #a78bfa 0%, #7c3aed 100%);
}

.stat-card.purple .stat-icon {
    background: rgba(168, 85, 247, 0.1);
    color: #a855f7;
}
```

---

## 🔄 4. Update Data Statistik di Controller

### Edit File
```
app/Http/Controllers/DashboardController.php
```

### Tambah Statistik Baru
```php
public function index()
{
    // Existing code...
    
    // Tambah statistik baru
    $penjualanHariIni = Sales::whereDate('created_at', today())->sum('total');
    $rataRataStok = Product::avg('stock');
    $topProduct = Product::withCount('orders')->orderByDesc('orders_count')->first();
    
    // Pass ke view
    return view('admin.dashboard', compact(
        'totalBarang',
        'barangTersedia',
        'barangHabis',
        'totalNilaiStok',
        'userName',
        'produkTerbaru',
        'penjualanHariIni',      // NEW
        'rataRataStok',          // NEW
        'topProduct'             // NEW
    ));
}
```

---

## 🎯 5. Mengubah Nama Perusahaan

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Lokasi (Topbar)
```blade
<a href="/admin/dashboard" class="topbar-logo">
    <i class="bi bi-boxes"></i>
    <span>PT. ABC Inventaris</span>  <!-- Ubah di sini -->
</a>
```

### Contoh
```blade
<span>PT. MAJU JAYA</span>
<span>Toko Elektronik ABC</span>
<span>Sistem Inventory Anda</span>
```

---

## 🔍 6. Mengubah Placeholder Halaman

### Edit File Pesanan
```
resources/views/admin/pesanan.blade.php
```

Contoh:
```blade
@extends('layouts.admin')

@section('title', 'Data Pesanan - Admin Inventaris')

@section('content')
<div class="page-header">
    <h1 class="page-title">Data Pesanan</h1>
    <p class="page-subtitle">Kelola semua pesanan masuk dari pelanggan</p>
</div>

<!-- Tambah konten table pesanan di sini -->
@endsection
```

### Edit File Laporan
```
resources/views/admin/laporan.blade.php
```

Contoh:
```blade
@extends('layouts.admin')

@section('title', 'Laporan - Admin Inventaris')

@section('content')
<div class="page-header">
    <h1 class="page-title">Laporan</h1>
    <p class="page-subtitle">Lihat laporan inventaris dan penjualan</p>
</div>

<!-- Tambah konten laporan di sini -->
@endsection
```

---

## 🎨 7. Mengubah Font & Typography

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Lokasi (Head section)
```html
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

### Ganti dengan Font Lain
```html
<!-- Roboto -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

Kemudian update CSS:
```css
* {
    font-family: 'Roboto', sans-serif;  /* Ganti di sini */
}
```

---

## 🌓 8. Mengubah Tema Warna Utama

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Warna Topbar
```css
.topbar {
    background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);  /* Hitam */
    /* atau */
    background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);  /* Biru */
}
```

### Warna Sidebar Active
```css
.sidebar-menu a.active {
    background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);  /* Ubah di sini */
}
```

### Warna User Avatar
```css
.user-avatar {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);  /* Hijau */
}
```

---

## 📱 9. Mengubah Layout Mobile

### Edit File
```
resources/views/layouts/admin.blade.php
```

### Responsive Media Query
```css
@media (max-width: 768px) {
    .sidebar {
        width: 100%;  /* Full width on mobile */
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .stats-container {
        grid-template-columns: 1fr;  /* Single column */
    }
}
```

---

## 🔒 10. Menambah Role-Based Access

### Update Routes
```php
// routes/web.php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    // ... other routes
});
```

### Buat Middleware
```bash
php artisan make:middleware IsAdmin
```

```php
// app/Http/Middleware/IsAdmin.php
public function handle($request, Closure $next)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
    return $next($request);
}
```

---

## 🚀 11. Optimasi Performa

### Query Optimization
```php
// DashboardController.php
public function index()
{
    // Gunakan select() untuk limit columns
    $produkTerbaru = Product::select(['id', 'name', 'stock', 'price', 'status'])
                            ->latest()
                            ->take(5)
                            ->get();
    
    // Cache hasil untuk stat yang jarang berubah
    $totalBarang = Cache::remember('total_barang', 3600, function () {
        return Product::count();
    });
}
```

### Lazy Loading
```blade
<!-- Di view, gunakan defer loading untuk gambar -->
<img src="image.png" loading="lazy">
```

---

## 🧪 12. Testing Customization

### Checklist
- [ ] Warna kartu berubah sesuai keinginan
- [ ] Menu baru muncul di sidebar
- [ ] Statistik baru menampilkan data benar
- [ ] Nama perusahaan terupdate
- [ ] Font berubah sesuai keinginan
- [ ] Responsive masih bekerja
- [ ] Tidak ada error di console browser
- [ ] Performance masih baik

---

## 📚 Resources

- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [Google Fonts](https://fonts.google.com/)
- [CSS Gradients](https://cssgradient.io/)
- [Laravel Docs](https://laravel.com/docs/)

---

## 💡 Tips & Tricks

1. **Test Changes Gradually** - Ubah satu hal sekaligus
2. **Use Browser DevTools** - F12 untuk debug CSS
3. **Cache Busting** - Hard refresh browser (Ctrl+Shift+R)
4. **Backup Original Files** - Sebelum banyak perubahan
5. **Comment Your Changes** - Untuk referensi masa depan

---

## ❓ FAQ

**Q: Bagaimana cara menambah filter di statistik?**
A: Update controller untuk menambah parameter date range ke query.

**Q: Bagaimana cara export data?**
A: Gunakan package seperti Maatwebsite Excel untuk export.

**Q: Bagaimana cara add real-time update?**
A: Gunakan Laravel Livewire atau Vue.js untuk live component.

**Q: Bagaimana cara add chart?**
A: Gunakan Chart.js atau Apex Charts untuk visualisasi data.

---

**Happy Customizing!** 🎉

Last Updated: 20 Mei 2026
