<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(
    [
        'prefix'     => 'login',
    ],
    function () {
        Route::post('/proses', [LoginController::class, 'authenticate'])->name('login.proses');
    }
);

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        route::resource('/data_user', UserController::class);
        Route::get('/profil', [UserController::class, 'profil'])->name('pengguna.profil');
        route::resource('/supplier', SupplierController::class);
        Route::get('/data_list', [SupplierController::class, 'data_list'])->name('supplier.data_list');
        route::resource('/satuan', SatuanController::class);
        route::resource('/produk', ProdukController::class);
        Route::get('/data_list_produk', [ProdukController::class, 'data_list'])->name('produk.data_list');
        route::resource('/pelanggan', PelangganController::class);
        route::resource('/aplikasi', AplikasiController::class);
        route::resource('/pembelian', PembelianController::class);
        Route::get('/data_list_pembelian', [PembelianController::class, 'data_list_pembelian'])->name('pembelian.data_list_pembelian');
        Route::get('/mengambil_data_produk', [PembelianController::class, 'mengambil_data_produk'])->name('pembelian.mengambil_data_produk');
        Route::post('/ambil_dataproduk', [PembelianController::class, 'ambil_dataproduk'])->name('pembelian.ambil_dataproduk');
        Route::post('/edit_bursa_pembelian', [PembelianController::class, 'edit_bursa_pembelian'])->name('pembelian.edit_jumlah_pembelian');
        route::resource('/stok', StokController::class);
        route::resource('/penjualan', PenjualanController::class);
        Route::get('/data_pelanggan', [PenjualanController::class, 'data_pelanggan'])->name('penjualan.data_pelanggan');
        Route::post('/obat_data_list', [PenjualanController::class, 'obat_data_list'])->name('penjualan.obat_list');
        route::resource('/laporan_penjualan', LaporanPenjualanController::class);
        route::resource('/laporan_pembelian', LaporanPembelianController::class);
    }
);
