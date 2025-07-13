<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;

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
});

// Auth routes dari Laravel Breeze
require __DIR__.'/auth.php';
