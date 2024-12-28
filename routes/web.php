<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\KontakController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Produk / Barang
    Route::get('/product',[ProductController::class,'index'])->name('product');
    Route::get('/add-product',[ProductController::class,'create'])->name('add_product');
    Route::post('/store-product',[ProductController::class,'store'])->name('store_product');

    // Kontak
    Route::get('/kontak',[KontakController::class,'index'])->name('kontak');
    Route::get('/add-kontak',[KontakController::class,'create'])->name('add_kontak');
    Route::post('/store-kontak',[KontakController::class,'store'])->name('store_kontak');
});

require __DIR__.'/auth.php';
