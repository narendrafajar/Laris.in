<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\KontakController;
use App\Http\Controllers\Transaction\ConsignorSaleController;
use App\Http\Controllers\Transaction\DirectSaleController;
use App\Http\Controllers\Transaction\CostController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    // Produk / Barang
    Route::get('/product',[ProductController::class,'index'])->name('product');
    Route::get('/add-product',[ProductController::class,'create'])->name('add_product');
    Route::post('/store-product',[ProductController::class,'store'])->name('store_product');

    // Kontak
    Route::get('/kontak',[KontakController::class,'index'])->name('kontak');
    Route::get('/add-kontak',[KontakController::class,'create'])->name('add_kontak');
    Route::post('/store-kontak',[KontakController::class,'store'])->name('store_kontak');

    // Penjualan Titip
    Route::get('/consignor-sale',[ConsignorSaleController::class,'index'])->name('jual_titip');
    Route::get('/add-consignor-sale',[ConsignorSaleController::class,'create'])->name('add_jual_titip');
    Route::get('/add-consignor-sale/getProduct/{id}',[ConsignorSaleController::class,'getProduct']);
    Route::post('/add-consignor-sale/store-consigner',[ConsignorSaleController::class,'store']);
    Route::get('/consignor-sale/complete-consginor/{id}',[ConsignorSaleController::class,'complete_consignors'])->name('complete_jual_titip');
    Route::post('/consignor-sale/update-consignor',[ConsignorSaleController::class,'updateComplete'])->name('update_jual_titip');
    Route::get('/consignor-sale/detail-consginor/{id}',[ConsignorSaleController::class,'detail_consignors'])->name('detail_jual_titip');
    Route::delete('/consignor-sale/delete-transaction',[ConsignorSaleController::class,'delete'])->name('delete_jual_titip');

    // Penjualan Langsung
    Route::get('/direct-sale',[DirectSaleController::class,'index'])->name('jual_langsung');


    // Pembelian
    Route::get('/cost',[CostController::class,'index'])->name('cost');
    Route::get('/add-cost',[CostController::class,'create'])->name('cost_add');
    Route::post('/add-cost/store-cost',[CostController::class,'store']);
    Route::get('/cost/detail-cost/{id}',[CostController::class,'detail'])->name('cost_detail');
});

require __DIR__.'/auth.php';
