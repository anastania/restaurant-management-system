<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\OrderController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products Management
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('products.update-stock');
    
    // Categories Management
    Route::resource('categories', CategoryController::class);
    
    // Ingredients Management
    Route::resource('ingredients', IngredientController::class);
    
    // Orders Management
    Route::resource('orders', OrderController::class);
    
    // Promo Codes Management
    Route::resource('promocodes', PromoCodeController::class);
});

require __DIR__.'/auth.php';
