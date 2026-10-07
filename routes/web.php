
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
Route::post('/registrasi', [RegistrasiController::class, 'store']);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Diagnosa (accessible for all, but stores history only for logged in)
Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa');
Route::post('/diagnosa/proses', [DiagnosaController::class, 'proses'])->name('diagnosa.proses');

// Riwayat (only for logged in users)
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat')->middleware('auth');
Route::get('/riwayat/print/{id}', [RiwayatController::class, 'printPdf'])->name('riwayat.print')->middleware('auth');

Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');

// Penyakit
Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Kelola Penyakit
    Route::get('/penyakit', [AdminController::class, 'penyakitIndex'])->name('admin.penyakit');
    Route::post('/penyakit', [AdminController::class, 'penyakitStore'])->name('admin.penyakit.store');
    Route::put('/penyakit/{id}', [AdminController::class, 'penyakitUpdate'])->name('admin.penyakit.update');
    Route::delete('/penyakit/{id}', [AdminController::class, 'penyakitDestroy'])->name('admin.penyakit.destroy');
    
    // Kelola Gejala
    Route::get('/gejala', [AdminController::class, 'gejalaIndex'])->name('admin.gejala');
    Route::post('/gejala', [AdminController::class, 'gejalaStore'])->name('admin.gejala.store');
    Route::put('/gejala/{id}', [AdminController::class, 'gejalaUpdate'])->name('admin.gejala.update');
    Route::delete('/gejala/{id}', [AdminController::class, 'gejalaDestroy'])->name('admin.gejala.destroy');
    
    // Kelola CF Rules
    Route::get('/rules', [AdminController::class, 'rulesIndex'])->name('admin.rules');
    Route::post('/rules', [AdminController::class, 'rulesStore'])->name('admin.rules.store');
    Route::put('/rules/{id}', [AdminController::class, 'rulesUpdate'])->name('admin.rules.update');
    Route::delete('/rules/{id}', [AdminController::class, 'rulesDestroy'])->name('admin.rules.destroy');
    
    // ================= LAPORAN =================
    Route::get('/laporan', [AdminController::class, 'laporanRiwayat'])
        ->name('admin.laporan');

    Route::get('/laporan/{id}', [AdminController::class, 'laporanDetail'])
        ->name('admin.laporan.detail');

    Route::get('/laporan/{id}/pdf', [AdminController::class, 'laporanPdf'])
        ->name('admin.laporan.detail.pdf');
    
    Route::delete('/admin/laporan/{id}', [AdminController::class, 'destroy'])
    ->name('admin.laporan.delete');

    Route::get('/admin/laporan/pdf-harian', [AdminController::class, 'laporanHarianPdf'])
    ->name('admin.laporan.harian.pdf');

});