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

Route::get('/penjualan', function(){
    return view('penjualan.index');
});

Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');

Route::get('/pelanggan', [App\Http\Controllers\ProdukController::class, 'store'])->name('pelanggan.store');

use App\Http\Controllers\PelangganController;

Route::resource('/pelanggan', PelangganController::class);

use App\Http\Controllers\PenjualanController;
Route::resource('/penjualan', PenjualanController::class);

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');

Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');

Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');

Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
