<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganBulananController;
use App\Http\Controllers\TransaksiUtangPiutangController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TargetController;

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




// --------------------
// HALAMAN AWAL (WELCOME, TANPA LOGIN)
// --------------------


// --------------------
// ROUTING AUTENTIKASI (SIGNUP & SIGNIN)
// --------------------
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signupProcess'])->name('signup.process');

Route::get('/signin', [AuthController::class, 'showSignin']);
Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::get('/signin', [AuthController::class, 'showSignin'])->name('login');

Route::post('/signin', [AuthController::class, 'signinProcess'])->name('signin.process');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');



// --------------------
// FITUR SETELAH LOGIN
// --------------------
Route::middleware('auth')->group(function () {

    // Halaman Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Jurnal Keuangan
    Route::get('/journal', [JournalController::class, 'index'])->name('journal');
    Route::post('/pemasukans/store', [JournalController::class, 'storePemasukan']);
    Route::post('/pengeluarans/store', [JournalController::class, 'storePengeluaran']);
    Route::delete('/pemasukans/{id}', [JournalController::class, 'destroyPemasukan']);
    Route::delete('/pengeluarans/{id}', [JournalController::class, 'destroyPengeluaran']);
    Route::get('/pemasukans/{id}/edit', [JournalController::class, 'editPemasukan']);
    Route::get('/pengeluarans/{id}/edit', [JournalController::class, 'editPengeluaran']);
    Route::put('/pemasukans/{id}', [JournalController::class, 'updatePemasukan']);
    Route::put('/pengeluarans/{id}', [JournalController::class, 'updatePengeluaran']);

    // Keuangan Bulanan
    Route::get('/keuangan-bulanan', [KeuanganBulananController::class, 'index'])->name('keuangan.bulanan');
    Route::post('/keuangan-bulanan', [KeuanganBulananController::class, 'store'])->name('keuangan.bulanan.store');

    // Transaksi Utang Piutang
    Route::get('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'index'])->name('utang-piutang.index');
    Route::post('/transaksi-utang-piutangs', [TransaksiUtangPiutangController::class, 'store'])->name('store');
    Route::get('/transaksi-utang-piutangs/{id}/edit', [TransaksiUtangPiutangController::class, 'edit']);
    Route::put('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'update']);
    Route::delete('/transaksi-utang-piutangs/{id}', [TransaksiUtangPiutangController::class, 'destroy']);

    // Reminder
    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
    Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
    Route::get('/reminders/{id}/edit', [ReminderController::class, 'edit'])->name('reminders.edit');
    Route::put('/reminders/{reminder}', [ReminderController::class, 'update'])->name('reminders.update');
    Route::delete('/reminders/{reminder}', [ReminderController::class, 'destroy'])->name('reminders.destroy');


Route::get('/target', [TargetController::class, 'index'])->name('target.index');
Route::post('/target', [TargetController::class, 'store'])->name('target.store');

Route::middleware(['auth'])->group(function () {
     Route::get('/journal', [JournalController::class, 'index'])->name('journal');
    Route::resource('pemasukan', PemasukanController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::resource('reminder', ReminderController::class);
    Route::resource('target', TargetController::class);
    Route::resource('transaksi_utang_piutang', TransaksiUtangPiutangController::class);
     Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


});
