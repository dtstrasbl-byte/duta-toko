<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Duta Bakery (PT Duta Jaya Bakery)
| Website Dinamis UMKM Kuliner Roti & Kue
|--------------------------------------------------------------------------
*/

// ==========================
// RUTE HALAMAN PUBLIK
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Katalog & Detail Produk Publik
Route::get('/katalog', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [PublicProductController::class, 'show'])->name('products.show');

// ==========================
// RUTE AUTH ADMIN (LOGIN / LOGOUT)
// ==========================
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ==========================
// RUTE HALAMAN ADMIN (CRUD) — Dilindungi Auth
// ==========================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Produk
    Route::resource('products', AdminProductController::class);

    // CRUD Kategori
    Route::resource('categories', AdminCategoryController::class)->except(['create', 'show', 'edit']);
});
