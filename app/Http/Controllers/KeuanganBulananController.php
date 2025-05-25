<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class KeuanganBulananController extends Controller
{
    public function index(Request $request)
    {
        // List tahun & bulan untuk dropdown
        $tahunList = range(2022, 2025);
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Ambil input user (default ke Mei 2025 jika tidak ada)
        $tahun = (int) $request->input('tahun', 2025);
        $bulan = (int) $request->input('bulan', 5); // Bulan sebagai angka

        // Validasi bulan
        if (!array_key_exists($bulan, $bulanList)) {
            abort(400, 'Bulan tidak valid.');
        }

        // Ambil user yang sedang login
        $userId = Auth::id();

        // Ambil total dari database sesuai bulan, tahun, dan user
        $totalPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('nominal');

        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('nominal');

        return view('keuangan-bulanan', [
            'tahunList' => $tahunList,
            'bulanList' => $bulanList,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran,
        ]);
    }
}
