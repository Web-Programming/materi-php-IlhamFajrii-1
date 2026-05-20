# 🎯 QUICK REFERENCE - Admin Dashboard

## 📍 URL Dashboard Admin
```
http://localhost:8000/admin/dashboard
```

## 👤 Login untuk Akses
```
Email: ilham.test@gmail.com
Password: password123
```

## 📊 4 Kartu Statistik

| Kartu | Warna | Icon | Data | Tujuan |
|-------|-------|------|------|--------|
| **Total Barang** | 🔵 Biru | 📦 | Semua produk | Overview stok |
| **Barang Tersedia** | 🟢 Hijau | ✓ | Siap jual | Produk aktif |
| **Barang Habis** | 🔴 Merah | ⚠️ | Perlu stok | Alert restocking |
| **Total Nilai Stok** | 🟠 Oranye | 💰 | Rupiah | Nilai aset |

## 🎨 Layout Struktur

```
┌─────────────────────────────────────────────────────┐
│        TOPBAR (Gelap) - Logo, Search, Profil       │ 70px
├──────────────┬──────────────────────────────────────┤
│              │                                      │
│   SIDEBAR    │        MAIN CONTENT                 │
│   (Putih)    │  - Judul & Sapaan                   │
│              │  - 4 Kartu Statistik               │
│   Menu:      │  - Tabel Produk Terbaru            │
│   • Dashboard│                                      │
│   • Pesanan  │                                      │
│   • Data Bar │                                      │
│   • Tambah B │                                      │
│   • Laporan  │                                      │
│   • Logout   │                                      │
└──────────────┴──────────────────────────────────────┘
```

## 📂 File Penting

| File | Fungsi |
|------|--------|
| `app/Http/Controllers/DashboardController.php` | Logic dashboard |
| `resources/views/layouts/admin.blade.php` | Layout template |
| `resources/views/admin/dashboard.blade.php` | View dashboard |
| `resources/views/admin/pesanan.blade.php` | Halaman pesanan |
| `resources/views/admin/laporan.blade.php` | Halaman laporan |

## 🔀 Menu Navigation

```
Dashboard (/admin/dashboard)
    ↓
Pesanan (/admin/pesanan) ← Placeholder
    ↓
Data Barang (/products)
    ↓
Tambah Barang (/products/create)
    ↓
Laporan (/admin/laporan) ← Placeholder
    ↓
Logout
```

## 💡 Fitur Utama

✅ Real-time statistik dari database  
✅ Topbar dengan search bar  
✅ Sidebar dengan menu terintegrasi  
✅ 4 kartu statistik berwarna  
✅ Tabel produk terbaru  
✅ Responsive design (mobile-friendly)  
✅ Integrasi autentikasi  

## 🎯 Customisasi

### Update Warna Kartu
Edit di `resources/views/layouts/admin.blade.php`
```css
.stat-card.blue::before { background: ... }
.stat-card.green::before { background: ... }
.stat-card.red::before { background: ... }
.stat-card.orange::before { background: ... }
```

### Update Menu
Edit di `resources/views/layouts/admin.blade.php`
```blade
<a href="/route-baru" class="...">
    <i class="bi bi-icon"></i>
    <span>Menu Baru</span>
</a>
```

### Update Statistik
Edit di `app/Http/Controllers/DashboardController.php`
```php
$newStat = Model::calculation();
return view('admin.dashboard', compact('newStat'));
```

## 🌐 Browser Support
- Chrome ✅
- Firefox ✅
- Safari ✅
- Edge ✅

## 📱 Responsive
- Desktop: Full layout
- Tablet: Optimized
- Mobile: Single column + toggle sidebar

---

**Status**: Production Ready ✅  
**Framework**: Laravel + Bootstrap 5  
**Last Updated**: 20 Mei 2026
