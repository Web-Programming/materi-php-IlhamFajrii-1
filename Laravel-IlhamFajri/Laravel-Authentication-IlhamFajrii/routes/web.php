<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route utama - landing page jika belum login, atau ke dashboard jika sudah
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/admin/dashboard');
    }
    return view('landing');
});

// Route Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin Menu Stubs (Pesanan & Laporan)
    Route::get('/admin/pesanan', function () {
        return view('admin.pesanan');
    })->name('admin.pesanan');
    
    Route::get('/admin/laporan', function () {
        return view('admin.laporan');
    })->name('admin.laporan');
    
    // Redirect /dashboard ke admin dashboard
    Route::redirect('/dashboard', '/admin/dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Product Routes
    Route::resource('products', ProductController::class);
});