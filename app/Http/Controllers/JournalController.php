<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{


    public function storePemasukan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pemasukan_fotos', 'public');
        }

        Pemasukan::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil disimpan');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengeluaran_fotos', 'public');
        }

        Pengeluaran::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil disimpan');
    }

    public function destroyPemasukan($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        if ($pemasukan->foto) {
            Storage::disk('public')->delete($pemasukan->foto);
        }

        $pemasukan->delete();

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil dihapus');
    }

    public function destroyPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        if ($pengeluaran->foto) {
            Storage::disk('public')->delete($pengeluaran->foto);
        }

        $pengeluaran->delete();

        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil dihapus');
    }

    public function editPemasukan($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
        return view('edit_pemasukan', compact('pemasukan', 'kategoriPemasukan'));
    }

    public function updatePemasukan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($pemasukan->foto) {
                Storage::disk('public')->delete($pemasukan->foto);
            }
            $pemasukan->foto = $request->file('foto')->store('pemasukan_fotos', 'public');
        }

        $pemasukan->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'foto' => $pemasukan->foto,
        ]);

        return redirect()->route('journal')->with('success', 'Pemasukan berhasil diperbarui');
    }

    public function editPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();
        return view('edit_pengeluaran', compact('pengeluaran', 'kategoriPengeluaran'));
    }

    public function updatePengeluaran(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($pengeluaran->foto) {
                Storage::disk('public')->delete($pengeluaran->foto);
            }
            $pengeluaran->foto = $request->file('foto')->store('pengeluaran_fotos', 'public');
        }

        $pengeluaran->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'foto' => $pengeluaran->foto,
        ]);

        return redirect()->route('journal')->with('success', 'Pengeluaran berhasil diperbarui');
    }

public function index()
{
    $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
    $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();

    // Ambil data pemasukan per kategori
    $pemasukan = DB::table('pemasukans')
        ->join('kategoris', 'pemasukans.kategori_id', '=', 'kategoris.id')
        ->select('kategoris.nama as kategori', DB::raw('SUM(pemasukans.nominal) as total'))
        ->groupBy('pemasukans.kategori_id', 'kategoris.nama')
        ->get();

    $chartPemasukanData = [
        'labels' => $pemasukan->pluck('kategori'),
        'data' => $pemasukan->pluck('total'),
    ];

    $labelsPemasukan = $pemasukan->pluck('kategori')->toArray();
    $valuesPemasukan = $pemasukan->pluck('total')->toArray();

    // Ambil data pengeluaran per kategori
    $pengeluaran = DB::table('pengeluarans')
        ->join('kategoris', 'pengeluarans.kategori_id', '=', 'kategoris.id')
        ->select('kategoris.nama as kategori', DB::raw('SUM(pengeluarans.nominal) as total'))
        ->groupBy('pengeluarans.kategori_id', 'kategoris.nama')
        ->get();

    $chartPengeluaranData = [
        'labels' => $pengeluaran->pluck('kategori'),
        'data' => $pengeluaran->pluck('total'),
    ];

    $labelsPengeluaran = $pengeluaran->pluck('kategori')->toArray();
    $valuesPengeluaran = $pengeluaran->pluck('total')->toArray();
    
    $totalPemasukan = array_sum($valuesPemasukan);
    $totalPengeluaran = array_sum($valuesPengeluaran);

    return view('journal', [
        'chartPemasukanData' => $chartPemasukanData,
        'chartPengeluaranData' => $chartPengeluaranData,
        'labelsPemasukan' => $labelsPemasukan,
        'valuesPemasukan' => $valuesPemasukan,
        'labelsPengeluaran' => $labelsPengeluaran,
        'valuesPengeluaran' => $valuesPengeluaran,
        'kategoriPemasukan' => $kategoriPemasukan,
        'kategoriPengeluaran' => $kategoriPengeluaran,
        'pemasukans' => Pemasukan::with('kategori')->get(),
        'pengeluarans' => Pengeluaran::with('kategori')->get(),
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran,
    ]);
}


}