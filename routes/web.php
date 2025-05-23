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

use App\Http\Controllers\TransaksiUtangPiutangController;

Route::get('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'index'])->name('utang-piutang.index');
Route::post('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'store']);
Route::get('/transaksi-utang-piutangs/{id}/edit', [TransaksiUtangPiutangController::class, 'edit']);
Route::put('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'update']);
Route::delete('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'destroy']);