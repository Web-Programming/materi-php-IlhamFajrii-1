# REST API Laravel Sanctum - Quick Start Guide

## 🚀 Setup Cepat

### Prasyarat
- PHP 8.2+
- Composer
- Database (SQLite, MySQL, atau PostgreSQL)
- Laravel 11

### Step 1: Verifikasi Laravel Sanctum

Laravel Sanctum biasanya sudah terinstall di Laravel 11. Jika belum, install dengan:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### Step 2: Setup Middleware

Buka file `bootstrap/app.php` dan pastikan middleware Sanctum sudah terdaftar:

```php
->withMiddleware(function (Middleware $middleware) {
    // Middleware sudah ada di sini
})
```

### Step 3: Jalankan Migrasi

```bash
php artisan migrate
```

### Step 4: Mulai Server

```bash
php artisan serve
```

API akan berjalan di: `http://localhost:8000/api`

---

## 🧪 Quick Test dengan cURL

### 1. Registrasi
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Ilham Fajri",
    "email": "ilham@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### 2. Login
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "ilham@example.com",
    "password": "password123"
  }'
```

**Catat token dari response!**

### 3. Get Profile
```bash
curl -X GET http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer TOKEN_ANDA_DI_SINI"
```

### 4. Get Semua Produk
```bash
curl -X GET http://localhost:8000/api/products \
  -H "Authorization: Bearer TOKEN_ANDA_DI_SINI"
```

### 5. Buat Produk
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Authorization: Bearer TOKEN_ANDA_DI_SINI" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Laptop",
    "price": 10000000,
    "unit": "Pcs",
    "stock": 5,
    "status": "aktif",
    "description": "Laptop berkualitas"
  }'
```

---

## 📱 Test dengan Postman

1. **Import Collection** (opsional)
   - Create koleksi baru: "Laravel API"
   - Create environment dengan variable:
     - `base_url`: `http://localhost:8000/api`
     - `token`: (update setelah login)

2. **Registrasi/Login** dulu untuk mendapatkan token

3. **Setup Authorization**
   - Type: Bearer Token
   - Token: Paste token dari login/register

4. **Test endpoint** sesuai dokumentasi

---

## 📁 Struktur API Endpoint

```
POST   /api/auth/register           - Registrasi user baru
POST   /api/auth/login              - Login dan dapatkan token
GET    /api/auth/me                 - Get profile user (auth required)
POST   /api/auth/logout             - Logout (auth required)
POST   /api/auth/refresh            - Refresh token (auth required)

GET    /api/products                - Get semua produk (auth required)
POST   /api/products                - Buat produk baru (auth required)
GET    /api/products/{id}           - Get detail produk (auth required)
PUT    /api/products/{id}           - Update produk (auth required)
DELETE /api/products/{id}           - Hapus produk (auth required)
GET    /api/products/search         - Cari produk (auth required)

GET    /api/health                  - Health check (no auth)
```

---

## 🔑 Cara Kerja Autentikasi Token

### Token Flow:

```
User Input (Email + Password)
           ↓
       Login API
           ↓
    Validate Credentials
           ↓
    Generate Token (Sanctum)
           ↓
    Return Token + User Data
           ↓
Client Simpan Token (localStorage)
           ↓
   Setiap Request: 
   Header: Authorization: Bearer {token}
           ↓
    Server Validate Token
           ↓
   Grant Access jika Valid
```

### Header Authorization Format:

```
Authorization: Bearer 7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij
```

---

## 🧑‍💻 Implementasi di Aplikasi

### Vue.js / React (Fetch API)

```javascript
// Simpan token di state
const [token, setToken] = useState(localStorage.getItem('api_token'));

// Fungsi untuk hit API dengan token
const apiCall = async (method, endpoint, data = null) => {
  const options = {
    method,
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  };
  
  if (data) {
    options.body = JSON.stringify(data);
  }
  
  const response = await fetch(`http://localhost:8000/api${endpoint}`, options);
  return response.json();
};

// Contoh penggunaan
const getProducts = async () => {
  const result = await apiCall('GET', '/products');
  console.log(result.data);
};

const createProduct = async (productData) => {
  const result = await apiCall('POST', '/products', productData);
  console.log(result);
};
```

### Axios

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api'
});

// Interceptor untuk tambah token ke setiap request
api.interceptors.request.use(config => {
  const token = localStorage.getItem('api_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Login
const login = async (email, password) => {
  try {
    const response = await api.post('/auth/login', { email, password });
    localStorage.setItem('api_token', response.data.token);
    return response.data;
  } catch (error) {
    console.error(error);
  }
};

// Get products
const getProducts = async () => {
  try {
    const response = await api.get('/products');
    return response.data.data;
  } catch (error) {
    console.error(error);
  }
};
```

---

## ⚠️ Common Issues & Solusi

| Masalah | Penyebab | Solusi |
|---------|---------|--------|
| "Unauthenticated" | Token tidak ada/invalid | Pastikan token disertakan di Authorization header |
| "Token Mismatch" | CORS issue | Setup CORS di middleware |
| 404 Not Found | Route tidak ditemukan | Pastikan `routes/api.php` sudah benar |
| 500 Internal Error | Database error | Cek error log di `storage/logs/` |
| Blank token response | Sanctum belum migrate | Jalankan `php artisan migrate` |

---

## 🔐 Security Tips

✅ **DO:**
- Gunakan HTTPS di production
- Set token expiration time
- Validate semua input
- Use CORS yang tepat
- Implement rate limiting

❌ **DON'T:**
- Expose token di URL
- Hardcode token di code
- Skip input validation
- Log sensitive data
- Allow unlimited API calls

---

## 📚 File-file Penting

| File | Deskripsi |
|------|-----------|
| `app/Http/Controllers/Api/AuthController.php` | Autentikasi endpoints |
| `app/Http/Controllers/Api/ProductController.php` | CRUD endpoints |
| `routes/api.php` | Route definitions |
| `app/Models/User.php` | User model + Sanctum |
| `DOKUMENTASI_REST_API.md` | Dokumentasi lengkap |

---

## 🔗 Useful Links

- [Full API Documentation](./DOKUMENTASI_REST_API.md)
- [Laravel Sanctum Docs](https://laravel.com/docs/sanctum)
- [Laravel Validation](https://laravel.com/docs/validation)

---

**Siap untuk mulai? Jalankan `php artisan serve` dan coba endpoints di atas!** 🚀
