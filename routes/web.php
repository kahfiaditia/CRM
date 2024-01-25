<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;

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
        Route::get('/profil', [UserController::class, 'profil'])->name('pengguna.profil');
        route::resource('/supplier', SupplierController::class);
        Route::get('/data_list', [SupplierController::class, 'data_list'])->name('supplier.data_list');
        route::resource('/jenis', JenisController::class);
        route::resource('/obat', ObatController::class);
        Route::get('/data_list_obat', [ObatController::class, 'data_list'])->name('obat.data_list');
        route::resource('/pelanggan', PelangganController::class);
        route::resource('/pembelian', PembelianController::class);
        Route::get('/data_list_pembelian', [PembelianController::class, 'data_list_pembelian'])->name('pembelian.data_list_pembelian');
        Route::get('/mengambil_data_obat', [PembelianController::class, 'mengambil_data_obat'])->name('pembelian.mengambil_data_obat');
        route::resource('/penjualan', PenjualanController::class);
        Route::get('/data_pelanggan', [PenjualanController::class, 'data_pelanggan'])->name('penjualan.data_pelanggan');
        Route::post('/obat_data_list', [PenjualanController::class, 'obat_data_list'])->name('penjualan.obat_list');
    }
);
