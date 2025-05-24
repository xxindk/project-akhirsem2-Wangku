<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganBulananController extends Controller
{
    public function index()
    {
        // Data dummy
        $tahun = 2025;
        $bulan = 'Mei';
        $pengeluaran = 7300000;
        $pemasukan = 16900000;

        return view('keuangan-bulanan', [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan,
        ]);
    }
}
