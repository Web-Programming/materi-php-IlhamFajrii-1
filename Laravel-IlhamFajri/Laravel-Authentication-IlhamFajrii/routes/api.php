<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut adalah route untuk REST API dengan Laravel Sanctum
| Base URL: /api
|
*/

// Route publik untuk autentikasi (tanpa middleware auth:sanctum)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
});

// Route yang memerlukan autentikasi (middleware auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');
        Route::get('/me', [AuthController::class, 'me'])->name('api.auth.me');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('api.auth.refresh');
    });

    // Product routes (CRUD)
    Route::apiResource('products', ProductController::class);
    
    // Product search route
    Route::get('/products/search', [ProductController::class, 'search'])->name('api.products.search');
});

// Health check endpoint (optional, bisa diakses tanpa login)
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'timestamp' => now()
    ]);
});
