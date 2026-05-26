# Dokumentasi Sistem Login & Register

## 📋 Ringkasan
Sistem autentikasi lengkap untuk aplikasi Laravel dengan halaman login, registrasi, dan dashboard yang dilindungi oleh middleware autentikasi.

## ✨ Fitur yang Tersedia

### 1. **Halaman Registrasi** (`/register`)
- Form pendaftaran dengan validasi lengkap
- Input: Nama, Email, Password, Konfirmasi Password
- Validasi:
  - Nama: required, max 255 karakter
  - Email: required, format email valid, unique (tidak boleh duplikat)
  - Password: required, minimum 6 karakter, harus sama dengan konfirmasi
- Setelah registrasi berhasil, user otomatis login dan redirect ke dashboard
- Link untuk login jika sudah memiliki akun

### 2. **Halaman Login** (`/login`)
- Form login dengan validasi email dan password
- Validasi:
  - Email: required, format email valid
  - Password: required
- Pesan error jika email atau password salah
- Link untuk registrasi jika belum memiliki akun
- Regenerasi session untuk keamanan

### 3. **Halaman Dashboard** (`/dashboard`) ⚡ [PROTECTED]
- Halaman selamat datang untuk user yang sudah login
- Menampilkan:
  - Nama user yang sedang login
  - Email user
  - Tanggal dan waktu registrasi
- Tombol untuk:
  - Lihat Produk (redirect ke `/products`)
  - Logout
- Dilindungi oleh middleware `auth`

### 4. **Halaman Manajemen Produk** (`/products`) ⚡ [PROTECTED]
- Halaman CRUD produk yang sudah ada
- Hanya bisa diakses jika sudah login
- Dilindungi oleh middleware `auth`

### 5. **Logout**
- Tombol logout di navbar dan dashboard
- Menghapus session user
- Regenerasi CSRF token untuk keamanan
- Redirect ke halaman login dengan pesan sukses

---

## 🔐 Middleware & Keamanan

### Protected Routes
Route yang memerlukan autentikasi (middleware `auth`):
- `GET /dashboard` - Dashboard user
- `POST /logout` - Logout user
- `GET /products` - Daftar produk
- `GET /products/create` - Form buat produk
- `POST /products` - Simpan produk
- `GET /products/{id}` - Detail produk
- `GET /products/{id}/edit` - Form edit produk
- `PUT /products/{id}` - Update produk
- `DELETE /products/{id}` - Hapus produk

### Public Routes
Route yang bisa diakses tanpa login:
- `GET /` - Redirect ke dashboard/login
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman registrasi
- `POST /register` - Proses registrasi

---

## 📁 File yang Dibuat/Dimodifikasi

### ✅ File Baru

1. **`app/Http/Controllers/AuthController.php`**
   - Controller untuk menangani autentikasi
   - Methods: `showLogin()`, `login()`, `showRegister()`, `register()`, `logout()`

2. **`resources/views/auth/login.blade.php`**
   - Template halaman login
   - Form dengan validasi Bootstrap 5

3. **`resources/views/auth/register.blade.php`**
   - Template halaman registrasi
   - Form dengan validasi Bootstrap 5
   - Input: nama, email, password, konfirmasi password

4. **`resources/views/dashboard.blade.php`**
   - Template dashboard user
   - Menampilkan informasi user dan tombol aksi

### ✏️ File yang Dimodifikasi

1. **`routes/web.php`**
   - Menambahkan routes untuk auth (login, register, logout)
   - Menambahkan middleware `auth` untuk melindungi routes produk dan dashboard
   - Route group untuk routes yang memerlukan autentikasi

---

## 🚀 Cara Menggunakan

### 1. **Registrasi User Baru**
```
1. Buka http://localhost:8000/register
2. Isi form dengan data lengkap
3. Klik tombol "Daftar"
4. Otomatis login dan redirect ke dashboard
```

### 2. **Login dengan Akun yang Sudah Ada**
```
1. Buka http://localhost:8000/login
2. Masukkan email dan password
3. Klik tombol "Masuk"
4. Redirect ke dashboard jika login berhasil
```

### 3. **Akses Produk**
```
1. Dari dashboard, klik tombol "Lihat Produk"
2. Atau akses langsung http://localhost:8000/products
3. Hanya bisa diakses jika sudah login
```

### 4. **Logout**
```
1. Klik tombol "Logout" di navbar atau dashboard
2. Session akan dihapus
3. Redirect ke halaman login
```

---

## 🧪 Testing yang Sudah Dilakukan

✅ Registrasi user baru berhasil
✅ User otomatis login setelah registrasi
✅ Redirect ke dashboard setelah login
✅ Logout berhasil dan redirect ke login
✅ Login dengan akun yang sudah ada berhasil
✅ Validasi form (email unique, password matching, dll)
✅ Middleware auth melindungi routes produk
✅ Navbar menampilkan tombol logout saat user login

---

## 🎨 Styling

- **Framework CSS**: Bootstrap 5.3.3
- **Font**: Poppins (Google Fonts)
- **Tema**: Modern dengan gradient background
- **Responsive**: Mobile-friendly design
- **Animasi**: Smooth transitions dan fade effects

---

## 📝 Model User

Model `User` sudah dikonfigurasi dengan:
- Fillable: `name`, `email`, `password`
- Hidden: `password`, `remember_token`
- Casts: `email_verified_at` sebagai datetime, `password` sebagai hashed

---

## ⚙️ Konfigurasi Database

Tabel `users` sudah disiapkan dengan struktur:
- `id` - Primary key
- `name` - Nama user
- `email` - Email unique
- `email_verified_at` - Nullable datetime
- `password` - Password ter-hash
- `remember_token` - Remember me token
- `created_at`, `updated_at` - Timestamps

---

## 🔧 Troubleshooting

### Masalah: Tidak bisa akses /products tanpa login
**Solusi**: Ini adalah behavior yang benar! Middleware `auth` melindungi route tersebut. Login terlebih dahulu.

### Masalah: Password tidak ter-hash
**Solusi**: Password otomatis di-hash oleh `Hash::make()` di AuthController.

### Masalah: Email sudah terdaftar
**Solusi**: Gunakan email yang belum terdaftar atau gunakan email testing yang berbeda.

---

## 📚 Struktur Alur Aplikasi

```
User Baru
   ↓
Kunjungi /register
   ↓
Isi form registrasi
   ↓
Submit (validasi di AuthController)
   ↓
Data disimpan ke database
   ↓
User otomatis login
   ↓
Redirect ke /dashboard
   ↓
User bisa akses /products dan menu lainnya
   ↓
Klik logout
   ↓
Session dihapus
   ↓
Redirect ke /login

---

User Lama (Login)
   ↓
Kunjungi /login
   ↓
Isi email & password
   ↓
Submit (validasi kredensial)
   ↓
Login berhasil
   ↓
Redirect ke /dashboard
   ↓
User bisa akses sistem
```

---

## ✅ Status Fitur

- ✅ Registrasi user baru
- ✅ Login dengan validasi
- ✅ Dashboard user
- ✅ Logout dengan session invalidate
- ✅ Middleware auth protection
- ✅ Validasi form lengkap
- ✅ Pesan error/success
- ✅ Responsive design
- ✅ Password hashing
- ✅ CSRF token protection

---

**Server Running**: http://127.0.0.1:8000
**Siap untuk Production**: Perlu konfigurasi `.env` dan keamanan tambahan
