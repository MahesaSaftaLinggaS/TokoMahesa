<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;

use App\Http\Requests\Auth\LoginRequest;

Route::get('/test-request', function () {
    return LoginRequest::class;
});



Route::middleware(['auth'])->group(function () {
    // Dashboard dari controller
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Produk & Pengeluaran
    Route::resource('products', ProductController::class);
    Route::resource('expenses', ExpenseController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Charts view route
    Route::view('/charts', 'charts')->name('charts');
});

// Auth routes dari Laravel Breeze
require __DIR__.'/auth.php';

//order
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders/summary', [\App\Http\Controllers\OrderController::class, 'summary'])->name('orders.summary');
});
