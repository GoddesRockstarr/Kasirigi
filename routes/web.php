<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\ProdukController;
Route::resource('/produk', ProdukController::class);

Route::get('/pindah', function(){
    return view('produk.index');
});

Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');

use App\Http\Controllers\PelangganController;

Route::resource('/pelanggan', PelangganController::class);

use App\Http\Controllers\PenjualanController;
Route::resource('/penjualan', PenjualanController::class);

