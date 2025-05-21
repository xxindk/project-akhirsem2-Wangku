<?php

namespace App\Http\Controllers;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
class HomeController extends Controller
{

public function index() {
    $pemasukans = Pemasukan::sum('nominal');
    $pengeluarans = Pengeluaran::sum('nominal');
    $balance = $pemasukans - $pengeluarans;

    $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
    $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();

    return view('home', compact('balance', 'kategoriPemasukan', 'kategoriPengeluaran'));
}


    

   public function journal() {
    $pemasukans = Pemasukan::with('kategori')->get();
    $pengeluarans = Pengeluaran::with('kategori')->get();
    $kategoris = Kategori::all(); 
    return view('journal', [
            'pemasukans' => Pemasukan::all(),
            'pengeluarans' => Pengeluaran::all(),
            'kategoris' => $kategoris,
        ]);

}
}