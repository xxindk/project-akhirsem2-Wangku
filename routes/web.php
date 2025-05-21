<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Simpan data
Route::post('/pemasukans/store', [JournalController::class, 'storePemasukan']);
Route::post('/pengeluarans/store', [JournalController::class, 'storePengeluaran']);


Route::get('/journal', [JournalController::class, 'index'])->name('journal');


// Hapus data
Route::delete('/pemasukans/{id}', [JournalController::class, 'destroyPemasukan']);
Route::delete('/pengeluarans/{id}', [JournalController::class, 'destroyPengeluaran']);

// Edit data (form edit)
Route::get('/pemasukans/{id}/edit', [JournalController::class, 'editPemasukan']);
Route::get('/pengeluarans/{id}/edit', [JournalController::class, 'editPengeluaran']);

// Update data
Route::put('/pemasukans/{id}', [JournalController::class, 'updatePemasukan']);
Route::put('/pengeluarans/{id}', [JournalController::class, 'updatePengeluaran']);
