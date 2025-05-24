<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganBulananController;

Route::get('/keuangan-bulanan', [KeuanganBulananController::class, 'index'])->name('keuangan.bulanan');


// --------------------
// HALAMAN AWAL (WELCOME, TANPA LOGIN)
// --------------------
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --------------------
// ROUTING AUTENTIKASI (SIGNUP & SIGNIN)
// --------------------
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signupProcess'])->name('signup.process');

Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::post('/signin', [AuthController::class, 'signinProcess'])->name('signin.process');

// --------------------
// HALAMAN UTAMA (SETELAH LOGIN)
// --------------------
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// --------------------
// FITUR JURNAL KEUANGAN
// --------------------
Route::middleware('auth')->group(function () {
    Route::get('/journal', [JournalController::class, 'index'])->name('journal');

    // Simpan data
    Route::post('/pemasukans/store', [JournalController::class, 'storePemasukan']);
    Route::post('/pengeluarans/store', [JournalController::class, 'storePengeluaran']);

    // Hapus data
    Route::delete('/pemasukans/{id}', [JournalController::class, 'destroyPemasukan']);
    Route::delete('/pengeluarans/{id}', [JournalController::class, 'destroyPengeluaran']);

    // Edit data
    Route::get('/pemasukans/{id}/edit', [JournalController::class, 'editPemasukan']);
    Route::get('/pengeluarans/{id}/edit', [JournalController::class, 'editPengeluaran']);

    // Update data
    Route::put('/pemasukans/{id}', [JournalController::class, 'updatePemasukan']);
    Route::put('/pengeluarans/{id}', [JournalController::class, 'updatePengeluaran']);
});
