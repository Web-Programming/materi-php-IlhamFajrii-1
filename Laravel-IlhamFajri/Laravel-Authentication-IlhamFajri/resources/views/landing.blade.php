<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan - Kelola Bisnis Anda dengan Mudah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-white font-sans text-gray-900">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <i class="bi bi-shop text-blue-400 text-2xl"></i>
                    <span class="text-xl font-bold">Aplikasi Penjualan</span>
                </div>

                <!-- Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="px-4 py-2 text-white hover:text-blue-400 transition duration-300 font-medium">
                        Login
                    </a>
                    <a href="/" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 font-medium">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Icon -->
            <div class="mb-6 flex justify-center">
                <div class="p-4 bg-blue-100 rounded-full">
                    <i class="bi bi-shop-window text-blue-500" style="font-size: 3rem;"></i>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Aplikasi Penjualan
            </h1>

            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed">
                Kelola data barang, pesanan, dan laporan penjualan dengan mudah. Tingkatkan efisiensi bisnis Anda dengan sistem manajemen yang lengkap dan user-friendly.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <!-- Login Button -->
                <a href="/login" class="flex items-center justify-center space-x-2 px-8 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300 shadow-md hover:shadow-lg">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>

                <!-- Daftar Button -->
                <a href="/register" class="flex items-center justify-center space-x-2 px-8 py-3 border-2 border-blue-500 text-blue-500 font-semibold rounded-lg hover:bg-blue-50 transition duration-300">
                    <i class="bi bi-person-plus"></i>
                    <span>Daftar Akun</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <!-- Section Title (optional) -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Fitur Utama</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola bisnis penjualan Anda dalam satu platform
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1: Manajemen Barang -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-8 border border-gray-100">
                    <div class="mb-6 flex justify-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="bi bi-box text-blue-500" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Manajemen Barang</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Tambah, edit, dan hapus data barang dengan cepat dan mudah. Kelola stok, harga, dan informasi produk dalam satu tempat.
                    </p>
                </div>

                <!-- Feature 2: Data Pesanan -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-8 border border-gray-100">
                    <div class="mb-6 flex justify-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="bi bi-receipt text-green-500" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Data Pesanan</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Pantau seluruh transaksi dan pesanan secara real-time. Kelola status pesanan dan tingkatkan kepuasan pelanggan Anda.
                    </p>
                </div>

                <!-- Feature 3: Laporan Penjualan -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-8 border border-gray-100">
                    <div class="mb-6 flex justify-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="bi bi-bar-chart text-yellow-500" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Laporan Penjualan</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Lihat ringkasan dan analisis laporan penjualan bulanan. Dapatkan insights untuk membuat keputusan bisnis yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-blue-500 to-blue-600">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap untuk Memulai?</h2>
            <p class="text-blue-100 text-lg mb-8">
                Daftar sekarang dan mulai kelola bisnis penjualan Anda dengan lebih efisien.
            </p>
            <a href="/register" class="inline-flex items-center space-x-2 px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                <i class="bi bi-person-plus"></i>
                <span>Buat Akun Gratis</span>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-gray-400">
                © 2026 Aplikasi Penjualan. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>
