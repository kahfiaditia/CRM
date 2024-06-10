<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilLaporanController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PenangananController;
use App\Http\Controllers\RelationController;
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


        route::resource('/leader', LeaderController::class);
        route::resource('/pelanggan', PelangganController::class);
        route::resource('/aplikasi', AplikasiController::class);
        route::resource('/relation', RelationController::class);
        Route::get('/mengambil_data_customer', [RelationController::class, 'mengambil_data_customer'])->name('relation.mengambil_data_customer');
        Route::get('/mengambil_data_aplikasi', [RelationController::class, 'mengambil_data_aplikasi'])->name('relation.mengambil_data_aplikasi');
        route::resource('/pelaporan', PelaporanController::class);
        route::resource('/penanganan', PenangananController::class);
        route::resource('/hasil', HasilLaporanController::class);
        route::resource('/pengaduan', HasilLaporanController::class);
    }
);
