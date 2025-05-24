<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganBulananController;
<<<<<<< HEAD
use App\Http\Controllers\TransaksiUtangPiutangController;
use App\Http\Controllers\ReminderController;
=======

use App\Models\Target;
Route::get('/keuangan-bulanan', [KeuanganBulananController::class, 'index'])->name('keuangan.bulanan');

>>>>>>> 833a28787516fab96e989f9911aa6df0006447ec

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

Route::get('/signin', [AuthController::class, 'showSignin'])->name('login'); // "login" digunakan oleh middleware auth
Route::post('/signin', [AuthController::class, 'signinProcess'])->name('signin.process');

// --------------------
// HALAMAN UTAMA (SETELAH LOGIN)
// --------------------
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// --------------------
// FITUR JURNAL KEUANGAN & LAINNYA (LOGIN DIBUTUHKAN)
// --------------------
Route::middleware('auth')->group(function () {

<<<<<<< HEAD
    // Jurnal Keuangan
    Route::get('/journal', [JournalController::class, 'index'])->name('journal');
=======

    // Simpan data
>>>>>>> 833a28787516fab96e989f9911aa6df0006447ec
    Route::post('/pemasukans/store', [JournalController::class, 'storePemasukan']);
    Route::post('/pengeluarans/store', [JournalController::class, 'storePengeluaran']);
    Route::delete('/pemasukans/{id}', [JournalController::class, 'destroyPemasukan']);
    Route::delete('/pengeluarans/{id}', [JournalController::class, 'destroyPengeluaran']);
    Route::get('/pemasukans/{id}/edit', [JournalController::class, 'editPemasukan']);
    Route::get('/pengeluarans/{id}/edit', [JournalController::class, 'editPengeluaran']);
    Route::put('/pemasukans/{id}', [JournalController::class, 'updatePemasukan']);
    Route::put('/pengeluarans/{id}', [JournalController::class, 'updatePengeluaran']);
<<<<<<< HEAD

    // Keuangan Bulanan
    Route::get('/keuangan-bulanan', [KeuanganBulananController::class, 'index'])->name('keuangan.bulanan');

    // Transaksi Utang Piutang
    Route::get('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'index'])->name('utang-piutang.index');
    Route::post('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'store']);
    Route::get('/transaksi-utang-piutangs/{id}/edit', [TransaksiUtangPiutangController::class, 'edit']);
    Route::put('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'update']);
    Route::delete('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'destroy']);

    // Reminder
    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
    Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
    Route::get('/reminders/{id}/edit', [ReminderController::class, 'edit'])->name('reminders.edit');
    Route::put('/reminders/{reminder}', [ReminderController::class, 'update'])->name('reminders.update');
    Route::delete('/reminders/{reminder}', [ReminderController::class, 'destroy'])->name('reminders.destroy');
});
=======
<<<<<<< HEAD
});
=======
});

use App\Http\Controllers\TargetController;

Route::resource('/target', TargetController::class);
>>>>>>> 1362181 (Simpan perubahan lokal sebelum pull)
>>>>>>> 833a28787516fab96e989f9911aa6df0006447ec