<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganBulananController extends Controller
{
    public function index(Request $request)
    {
        // List tahun & bulan untuk dropdown
        $tahunList = range(2022, 2025);
        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Ambil input user (default ke Mei 2025 jika tidak ada)
        $tahun = $request->input('tahun', 2025);
        $bulan = $request->input('bulan', 'Mei');

        // Data dummy berdasarkan bulan dan tahun (bisa disesuaikan)
        $pengeluaran = 7300000;
        $pemasukan = 16900000;

        return view('keuangan-bulanan', [
            'tahunList' => $tahunList,
            'bulanList' => $bulanList,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan,
        ]);
    }
}
