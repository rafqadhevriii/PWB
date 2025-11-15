<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // ANGGOTA
    Route::resource('anggota', AnggotaController::class)->names([
        'index' => 'dataAnggota',
        'create' => 'createAnggota',
        'store' => 'storeAnggota',
        'edit' => 'editAnggota',
        'update' => 'updateAnggota',
        'destroy' => 'deleteAnggota'
    ]);

    // BUKU
    Route::resource('buku', BukuController::class)->names([
        'index' => 'dataBuku',
        'create' => 'createDataBuku',
        'store' => 'storeDataBuku',
        'edit' => 'editDataBuku',
        'update' => 'updateDataBuku',
        'destroy' => 'deleteDataBuku'
    ]);

    // PEMINJAMAN (Admin)
    Route::get('/data-peminjaman', [PeminjamanController::class, 'index'])
        ->name('dataPeminjaman');

    Route::post('/data-peminjaman/kembalikan/{id}',
        [PeminjamanController::class, 'adminKembalikan'])
        ->name('admin.kembalikan');

    Route::delete('/data-peminjaman/delete/{id}',
        [PeminjamanController::class, 'destroy'])
        ->name('deletePeminjaman');

    // PENGEMBALIAN (Admin)
    Route::get('/data-pengembalian', [PengembalianController::class, 'index'])
        ->name('dataPengembalian');

    // LAPORAN
    Route::get('/data-laporan', [LaporanController::class, 'index'])->name('dataLaporan');
    Route::get('/cetak-laporan', [LaporanController::class, 'cetakLaporan'])->name('cetakLaporan');
});

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/katalog-buku', [BukuController::class, 'katalogBuku'])
        ->name('katalogBuku');

    Route::post('/pinjam-buku/{id}', [PeminjamanController::class, 'pinjamBuku'])
        ->name('pinjamBuku');

    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayatPeminjaman'])
        ->name('riwayatPeminjaman');

    Route::post('/pengembalian/kembalikan/{id}', [PengembalianController::class, 'kembalikan'])->name('kembalikanBuku');
});

Route::middleware('auth')->group(function () {

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Edit profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Update profil
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});





