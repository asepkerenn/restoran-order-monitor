<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;

/* --- PELANGGAN --- */
Route::get('/', [OrderController::class, 'welcome']);
Route::get('/order', [OrderController::class, 'order']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/thanks', [OrderController::class, 'thanks'])->name('order.thanks');

/* --- LOGIN & LOGOUT --- */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* --- KASIR (WAJIB LOGIN) --- */
Route::middleware(['auth'])->group(function () {
    // Dashboard Kasir menampilkan daftar pesanan masuk
    Route::get('/kasir', [KasirController::class, 'index'])->name('dashboard');
    Route::resource('menu', MenuController::class)->except(['show']);
    Route::delete('/kasir/order/{id}', [KasirController::class, 'destroy'])->name('kasir.order.destroy');
    Route::delete('/kasir/clear-all', [KasirController::class, 'clearAll'])->name('kasir.clear-all');
    Route::delete('/kasir/order/{id}', [KasirController::class, 'destroy'])->name('kasir.order.destroy');
    Route::resource('menu', MenuController::class);
});