<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/DataBuku', function () {
    return view('dataBuku');
})->name('dataBuku');

Route::get('/DataAnggota', function () {
    return view('dataAnggota');
})->name ('dataAnggota');

Route::get('/DataPeminjaman', function () {
    return view('dataPeminjaman');
})->name('dataPeminjaman');

Route::get('/DataPengembalian', function () {
    return view('dataPengembalian');
})->name('dataPengembalian');

Route::get('/DataLaporan', function () {
    return view('dataLaporan');
})->name('dataLaporan');

Route::get('/KatalogBuku', function () {
    return view('katalogBuku');
})->name('katalogBuku');

Route::get('/RiwayatPeminjaman', function () {
    return view('riwayatPeminjaman');
})->name('riwayatPeminjaman');