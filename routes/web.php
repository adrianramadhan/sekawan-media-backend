<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/export/pemesanan', [ExportController::class, 'exportPemesanan'])->name('export.pemesanan');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function() {
        Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
        Route::post('/kendaraan/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/kendaraan/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
        Route::put('/kendaraan/{kendaraan}', [KendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/kendaraan/{kendaraan}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');

        Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
        Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store');
        Route::get('/driver/{driver}/edit', [DriverController::class, 'edit'])->name('driver.edit');
        Route::put('/driver/{driver}', [DriverController::class, 'update'])->name('driver.update');
        Route::delete('/driver/{driver}', [DriverController::class, 'destroy'])->name('driver.destroy');

        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
        Route::post('/pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{pemesanan}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
        Route::put('/pemesanan/{pemesanan}', [PemesananController::class, 'update'])->name('pemesanan.update');
        Route::delete('/pemesanan/{pemesanan}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    });

    Route::prefix('approver')->middleware('role:Approver')->name('approver.')->group(function() {
        Route::get('/persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');
        Route::post('/persetujuan/{id}/approve', [PersetujuanController::class, 'approve'])->name('persetujuan.approve');
        Route::post('/persetujuan/{id}/reject', [PersetujuanController::class, 'reject'])->name('persetujuan.reject');
    });
});
require __DIR__.'/auth.php';
