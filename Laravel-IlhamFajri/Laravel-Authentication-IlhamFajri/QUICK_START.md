# 🚀 QUICK START - Sistem Login & Register

## Akun Test yang Sudah Dibuat
- **Email**: ilham.test@gmail.com
- **Password**: password123
- **Nama**: Ilham Fajri

## 📌 URL Penting
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/register
- **Dashboard**: http://localhost:8000/dashboard (hanya jika sudah login)
- **Produk**: http://localhost:8000/products (hanya jika sudah login)

## 🔑 Alur Penggunaan

### Opsi 1: Login dengan Akun Test
1. Buka http://localhost:8000/login
2. Masukkan email: `ilham.test@gmail.com`
3. Masukkan password: `password123`
4. Klik "Masuk"

### Opsi 2: Registrasi User Baru
1. Buka http://localhost:8000/register
2. Isi form dengan data Anda
3. Klik "Daftar"
4. Otomatis login ke dashboard

## 📂 File yang Dibuat
```
app/Http/Controllers/
  └── AuthController.php          (baru)

resources/views/
  ├── auth/
  │   ├── login.blade.php         (baru)
  │   └── register.blade.php      (baru)
  └── dashboard.blade.php         (baru)

routes/
  └── web.php                     (modified)
```

## 🎯 Fitur Utama
✅ Registrasi dengan validasi email unique  
✅ Login dengan password verification  
✅ Otomatis login setelah registrasi  
✅ Dashboard welcome page  
✅ Logout dengan session clear  
✅ Protected routes (hanya untuk user login)  
✅ Responsive design dengan Bootstrap 5  

## 🔒 Keamanan
- Password ter-hash dengan bcrypt
- CSRF protection
- Session validation
- Email uniqueness check
- Password confirmation matching

---

Semua siap! Silakan test sistem login dan register Anda 🎉
