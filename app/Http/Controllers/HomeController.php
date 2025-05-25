<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::where('user_id', Auth::id())->sum('nominal');
        $pengeluarans = Pengeluaran::where('user_id', Auth::id())->sum('nominal');
        $balance = $pemasukans - $pengeluarans;

        $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
        $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();

        return view('home', compact('balance', 'kategoriPemasukan', 'kategoriPengeluaran'));
    }
}
