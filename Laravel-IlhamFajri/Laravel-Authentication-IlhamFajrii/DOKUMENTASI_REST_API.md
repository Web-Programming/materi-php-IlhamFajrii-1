# REST API dengan Laravel Sanctum - Dokumentasi Lengkap

## 📖 Pengantar

Dokumentasi ini menjelaskan cara menggunakan REST API yang telah dibangun dengan Laravel Sanctum untuk autentikasi berbasis token. API ini menyediakan fitur CRUD lengkap untuk modul Produk (Barang) dengan autentikasi token.

**Base URL:** `http://localhost:8000/api`

---

## 🔐 Autentikasi dengan Laravel Sanctum

### Apa itu Laravel Sanctum?

Laravel Sanctum adalah sistem autentikasi yang ringan dan sederhana untuk membangun REST API. Sanctum menggunakan **token-based authentication** yang aman untuk aplikasi single-page dan mobile.

### Cara Kerja:
1. User melakukan registrasi atau login
2. Server memberikan token API
3. Client mengirimkan token di setiap request di header `Authorization: Bearer {token}`
4. Server memvalidasi token dan memberikan akses ke resource

---

## 🔑 Endpoint Autentikasi

### 1. Registrasi (Register)
**Method:** `POST`  
**URL:** `/api/auth/register`  
**Auth Required:** Tidak

**Request Body:**
```json
{
  "name": "Ilham Fajri",
  "email": "ilham@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Registrasi berhasil",
  "user": {
    "id": 1,
    "name": "Ilham Fajri",
    "email": "ilham@example.com",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:00:00.000000Z"
  },
  "token": "7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij"
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "email": ["Email sudah digunakan"]
  }
}
```

---

### 2. Login
**Method:** `POST`  
**URL:** `/api/auth/login`  
**Auth Required:** Tidak

**Request Body:**
```json
{
  "email": "ilham@example.com",
  "password": "password123"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Login berhasil",
  "user": {
    "id": 1,
    "name": "Ilham Fajri",
    "email": "ilham@example.com",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:00:00.000000Z"
  },
  "token": "7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij"
}
```

**Response Error (401):**
```json
{
  "success": false,
  "message": "Email atau password salah"
}
```

---

### 3. Get User Data (Profil)
**Method:** `GET`  
**URL:** `/api/auth/me`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer 7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Data user berhasil diambil",
  "user": {
    "id": 1,
    "name": "Ilham Fajri",
    "email": "ilham@example.com",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:00:00.000000Z"
  }
}
```

---

### 4. Logout (Revoke Token)
**Method:** `POST`  
**URL:** `/api/auth/logout`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer 7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

### 5. Refresh Token
**Method:** `POST`  
**URL:** `/api/auth/refresh`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer 7|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Token berhasil diperbarui",
  "token": "8|NEWTOKENABCDEFGHIJKLMNOPQRSTUVWXYZabcdef"
}
```

---

## 📦 Endpoint Produk (CRUD)

> **⚠️ PENTING:** Semua endpoint produk memerlukan autentikasi token

### 1. Mendapatkan Semua Produk
**Method:** `GET`  
**URL:** `/api/products`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Data produk berhasil diambil",
  "data": [
    {
      "id": 1,
      "name": "Laptop",
      "price": 10000000,
      "unit": "Pcs",
      "stock": 5,
      "status": "aktif",
      "description": "Laptop berkualitas tinggi",
      "created_at": "2026-05-26T10:00:00.000000Z",
      "updated_at": "2026-05-26T10:00:00.000000Z"
    },
    {
      "id": 2,
      "name": "Mouse",
      "price": 150000,
      "unit": "Pcs",
      "stock": 50,
      "status": "aktif",
      "description": "Mouse wireless",
      "created_at": "2026-05-26T10:00:00.000000Z",
      "updated_at": "2026-05-26T10:00:00.000000Z"
    }
  ]
}
```

---

### 2. Membuat Produk Baru
**Method:** `POST`  
**URL:** `/api/products`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Request Body:**
```json
{
  "name": "Keyboard Mekanik",
  "price": 500000,
  "unit": "Pcs",
  "stock": 20,
  "status": "aktif",
  "description": "Keyboard mekanik dengan LED RGB"
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Produk berhasil ditambahkan",
  "data": {
    "id": 3,
    "name": "Keyboard Mekanik",
    "price": 500000,
    "unit": "Pcs",
    "stock": 20,
    "status": "aktif",
    "description": "Keyboard mekanik dengan LED RGB",
    "created_at": "2026-05-26T10:15:00.000000Z",
    "updated_at": "2026-05-26T10:15:00.000000Z"
  }
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "name": ["Field name diperlukan"],
    "price": ["Field price harus berupa angka"]
  }
}
```

---

### 3. Mendapatkan Detail Produk
**Method:** `GET`  
**URL:** `/api/products/{id}`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Contoh URL:** `/api/products/1`

**Response Success (200):**
```json
{
  "success": true,
  "message": "Data produk berhasil diambil",
  "data": {
    "id": 1,
    "name": "Laptop",
    "price": 10000000,
    "unit": "Pcs",
    "stock": 5,
    "status": "aktif",
    "description": "Laptop berkualitas tinggi",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:00:00.000000Z"
  }
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "Produk tidak ditemukan"
}
```

---

### 4. Memperbarui Produk
**Method:** `PUT`  
**URL:** `/api/products/{id}`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Contoh URL:** `/api/products/1`

**Request Body:**
```json
{
  "name": "Laptop Gaming",
  "price": 15000000,
  "stock": 3
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Produk berhasil diperbarui",
  "data": {
    "id": 1,
    "name": "Laptop Gaming",
    "price": 15000000,
    "unit": "Pcs",
    "stock": 3,
    "status": "aktif",
    "description": "Laptop berkualitas tinggi",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:30:00.000000Z"
  }
}
```

---

### 5. Menghapus Produk
**Method:** `DELETE`  
**URL:** `/api/products/{id}`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Contoh URL:** `/api/products/1`

**Response Success (200):**
```json
{
  "success": true,
  "message": "Produk berhasil dihapus",
  "data": {
    "id": 1,
    "name": "Laptop Gaming",
    "price": 15000000,
    "unit": "Pcs",
    "stock": 3,
    "status": "aktif",
    "description": "Laptop berkualitas tinggi",
    "created_at": "2026-05-26T10:00:00.000000Z",
    "updated_at": "2026-05-26T10:30:00.000000Z"
  }
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "Produk tidak ditemukan"
}
```

---

### 6. Mencari Produk
**Method:** `GET`  
**URL:** `/api/products/search?keyword=...&status=...`  
**Auth Required:** Ya

**Header:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Query Parameters:**
- `keyword` (optional): Cari berdasarkan nama atau deskripsi produk
- `status` (optional): Filter berdasarkan status (aktif/nonaktif)

**Contoh URL:** `/api/products/search?keyword=laptop&status=aktif`

**Response Success (200):**
```json
{
  "success": true,
  "message": "Pencarian produk berhasil",
  "data": [
    {
      "id": 1,
      "name": "Laptop Gaming",
      "price": 15000000,
      "unit": "Pcs",
      "stock": 3,
      "status": "aktif",
      "description": "Laptop berkualitas tinggi",
      "created_at": "2026-05-26T10:00:00.000000Z",
      "updated_at": "2026-05-26T10:30:00.000000Z"
    }
  ]
}
```

---

## 📝 Validasi Data Produk

Berikut adalah rule validasi untuk setiap field produk:

| Field | Type | Rule | Deskripsi |
|-------|------|------|-----------|
| `name` | String | Required, Max 255 | Nama produk wajib diisi |
| `price` | Number | Required, Min 0 | Harga produk, minimal 0 |
| `unit` | String | Required, Max 50 | Satuan produk (Pcs, Kg, Box, dll) |
| `stock` | Integer | Required, Min 0 | Jumlah stok, minimal 0 |
| `status` | String | Required, in: aktif,nonaktif | Status hanya aktif atau nonaktif |
| `description` | String | Nullable | Deskripsi produk (opsional) |

---

## 🧪 Testing API dengan Postman

### Step 1: Setup Koleksi
1. Buka Postman
2. Buat koleksi baru: "Laravel Sanctum API"
3. Buat environment baru dengan variable:
   - `base_url`: `http://localhost:8000/api`
   - `token`: (akan diisi setelah login)

### Step 2: Registrasi User
1. Buat request `POST` ke `{{base_url}}/auth/register`
2. Di tab **Body**, pilih `raw` dan `JSON`
3. Masukkan data registrasi:
```json
{
  "name": "Ilham Fajri",
  "email": "ilham@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```
4. Klik Send
5. Copy token dari response dan simpan ke environment variable `token`

### Step 3: Get User Profile
1. Buat request `GET` ke `{{base_url}}/auth/me`
2. Di tab **Headers**, tambahkan:
   - Key: `Authorization`
   - Value: `Bearer {{token}}`
3. Klik Send

### Step 4: Buat Produk
1. Buat request `POST` ke `{{base_url}}/products`
2. Di tab **Headers**, tambahkan header Authorization
3. Di tab **Body**, masukkan:
```json
{
  "name": "Laptop",
  "price": 10000000,
  "unit": "Pcs",
  "stock": 5,
  "status": "aktif",
  "description": "Laptop berkualitas tinggi"
}
```
4. Klik Send

### Step 5: Get Semua Produk
1. Buat request `GET` ke `{{base_url}}/products`
2. Tambahkan Authorization header
3. Klik Send

---

## 🔍 Error Response Codes

| Status Code | Deskripsi | Contoh |
|-------------|-----------|---------|
| 200 | OK - Request berhasil | GET, PUT, DELETE |
| 201 | Created - Resource berhasil dibuat | POST create |
| 401 | Unauthorized - Token invalid/expired | Tanpa token |
| 404 | Not Found - Resource tidak ditemukan | GET produk yang tidak ada |
| 422 | Unprocessable Entity - Validasi gagal | Field tidak sesuai |
| 500 | Internal Server Error - Error server | Database error |

---

## 🛠️ Implementasi di Frontend (JavaScript/Fetch API)

### Contoh: Registrasi
```javascript
async function register() {
  const response = await fetch('http://localhost:8000/api/auth/register', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: 'Ilham Fajri',
      email: 'ilham@example.com',
      password: 'password123',
      password_confirmation: 'password123'
    })
  });
  
  const data = await response.json();
  console.log(data);
  
  if (data.success) {
    localStorage.setItem('api_token', data.token);
  }
}
```

### Contoh: Login
```javascript
async function login() {
  const response = await fetch('http://localhost:8000/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      email: 'ilham@example.com',
      password: 'password123'
    })
  });
  
  const data = await response.json();
  
  if (data.success) {
    localStorage.setItem('api_token', data.token);
  }
}
```

### Contoh: Get Semua Produk
```javascript
async function getProducts() {
  const token = localStorage.getItem('api_token');
  
  const response = await fetch('http://localhost:8000/api/products', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  });
  
  const data = await response.json();
  console.log(data.data);
}
```

### Contoh: Buat Produk
```javascript
async function createProduct() {
  const token = localStorage.getItem('api_token');
  
  const response = await fetch('http://localhost:8000/api/products', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: 'Keyboard',
      price: 500000,
      unit: 'Pcs',
      stock: 20,
      status: 'aktif',
      description: 'Keyboard mekanik'
    })
  });
  
  const data = await response.json();
  console.log(data);
}
```

### Contoh: Update Produk
```javascript
async function updateProduct(id) {
  const token = localStorage.getItem('api_token');
  
  const response = await fetch(`http://localhost:8000/api/products/${id}`, {
    method: 'PUT',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: 'Keyboard Mekanik',
      price: 600000,
      stock: 15
    })
  });
  
  const data = await response.json();
  console.log(data);
}
```

### Contoh: Delete Produk
```javascript
async function deleteProduct(id) {
  const token = localStorage.getItem('api_token');
  
  const response = await fetch(`http://localhost:8000/api/products/${id}`, {
    method: 'DELETE',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  });
  
  const data = await response.json();
  console.log(data);
}
```

---

## 📚 Struktur File

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AuthController.php      # Autentikasi
│           └── ProductController.php   # CRUD Produk
└── Models/
    ├── User.php                        # User dengan Sanctum
    └── Product.php                     # Model Produk

routes/
└── api.php                             # Route API

database/
└── migrations/
    └── *_create_products_table.php    # Migration Produk
```

---

## 🔒 Best Practice Keamanan

1. **Jangan expose token** di URL atau hardcode
2. **Simpan token secara aman** di localStorage atau cookie
3. **Gunakan HTTPS** di production
4. **Validasi input** di backend
5. **Set token expiration** sesuai kebutuhan
6. **Revoke token** saat logout
7. **Rate limiting** untuk mencegah brute force

---

## 📞 Troubleshooting

### Error: "Unauthenticated"
**Solusi:** Pastikan token disertakan di header Authorization dan token masih valid

### Error: "Token Mismatch"
**Solusi:** Pastikan CSRF token (jika menggunakan form) atau Authorization header sudah benar

### Error: "Validation Failed"
**Solusi:** Periksa data input sesuai dengan validasi yang ditentukan

### Error: "Method Not Allowed"
**Solusi:** Pastikan HTTP method (GET, POST, PUT, DELETE) sudah sesuai

---

## 📖 Referensi

- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [Laravel API Resource](https://laravel.com/docs/eloquent-resources)
- [Postman API Testing](https://www.postman.com/)

---

**Dibuat:** 26 Mei 2026  
**Framework:** Laravel 11  
**Auth:** Laravel Sanctum
