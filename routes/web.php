<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KokabController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kokab', KokabController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('stokis', StokisController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::get('penjualan/{stokis_id}/detail', [PenjualanController::class, 'detail'])->name('penjualan.detail');
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
