<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SewaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT DEFAULT
|--------------------------------------------------------------------------
*/
// Supaya middleware `auth` tahu ke mana harus redirect jika belum login
Route::get('/login', function () {
    return redirect()->route('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (KHUSUS ADMIN)
|--------------------------------------------------------------------------
|
| Hanya bisa diakses oleh admin. Middleware `isAdmin` harus sudah didaftarkan
| di bootstrap/app.php
|
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contoh route admin lain:
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('index');
        Route::get('/create', [BarangController::class, 'create'])->name('create');
        Route::post('/store', [BarangController::class, 'store'])->name('store');
        Route::get('/show/{id}', [BarangController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BarangController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BarangController::class, 'destroy'])->name('destroy');
    });

    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
});

/*
|--------------------------------------------------------------------------
| HALAMAN USER (SETELAH LOGIN)
|--------------------------------------------------------------------------
|
| Ini untuk user biasa (bukan admin). Mereka bisa lihat barang, sewa, dll.
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [IndexController::class, 'index'])->name('index');
    Route::get('/barang/{id}', [BarangController::class, 'detail'])->name('barang.show');
    Route::post('/barang/{id}/sewa', [SewaController::class, 'store'])->name('barang.sewa');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/pay/{order}', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::post('/checkout/pay/{order}', [CheckoutController::class, 'uploadPayment'])->name('checkout.upload');
});
