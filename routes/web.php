<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
=======
use App\Http\Controllers\ReminderController;
>>>>>>> 669e4803adf56f05c3807b8216c6118e8cab53ac

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

<<<<<<< HEAD
    // Update data
    Route::put('/pemasukans/{id}', [JournalController::class, 'updatePemasukan']);
    Route::put('/pengeluarans/{id}', [JournalController::class, 'updatePengeluaran']);
});
=======
use App\Http\Controllers\TransaksiUtangPiutangController;

Route::get('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'index'])->name('utang-piutang.index');
Route::post('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'store']);
Route::get('/transaksi-utang-piutangs/{id}/edit', [TransaksiUtangPiutangController::class, 'edit']);
Route::put('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'update']);
Route::delete('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'destroy']);

Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders/{id}/edit', [ReminderController::class, 'edit'])->name('reminders.edit');
Route::put('/reminders/{reminder}', [ReminderController::class, 'update'])->name('reminders.update');
Route::delete('/reminders/{reminder}', [ReminderController::class, 'destroy'])->name('reminders.destroy');
>>>>>>> 669e4803adf56f05c3807b8216c6118e8cab53ac
