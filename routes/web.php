<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use Illuminate\Routing\RouteGroup;

//login
route::get('/login',[UserController::class,'index'])->name('login');
route::post('/login/cek',[UserController::class,'cekLogin'])->name('cekLogin');
route::get('/logout',[UserController::class,'logout'])->name('logout');

//route untuk yang sudah login
Route::Group(['middleware' => 'auth'], function(){
    route::get('/',[HomeController::class,'index']);
    route::get('profile', [HomeController::class,'profile']);
    route::get('dashboard', [HomeController::class,'dashboard']);
    route::get('contact', [HomeController::class,'contact']);
    route::get('FAQ', [HomeController::class,'FAQ']);
    route::resource('produk', ProdukController::class);
    route::resource('pelanggan', PelangganController::class);
    route::resource('pemasok', PemasokController::class);
    route::resource('barang', BarangController::class);
    route::resource('pembelian', PembelianController::class);
});