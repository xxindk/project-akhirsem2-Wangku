<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use App\Charts\PemasukanChart;
use App\Charts\PengeluaranChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
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

public function index(PemasukanChart $pemasukanChart, PengeluaranChart $pengeluaranChart)
{
    $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
    $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();

    // Ambil data pemasukan per kategori
    $dataPemasukan = Pemasukan::with('kategori')
        ->selectRaw('kategori_id, SUM(nominal) as total')
        ->groupBy('kategori_id')
        ->get();

    $labelsPemasukan = $dataPemasukan->pluck('kategori.nama')->toArray();
    $valuesPemasukan = $dataPemasukan->pluck('total')->toArray();

    // Buat chart pemasukan
    $chartPemasukan = (new LarapexChart)->pieChart()
        ->setTitle('Pemasukan Berdasarkan Kategori')
        ->setLabels($labelsPemasukan)
        ->addData($valuesPemasukan);

    // Ambil data pengeluaran per kategori
    $dataPengeluaran = Pengeluaran::with('kategori')
        ->selectRaw('kategori_id, SUM(nominal) as total')
        ->groupBy('kategori_id')
        ->get();

    $labelsPengeluaran = $dataPengeluaran->pluck('kategori.nama')->toArray();
    $valuesPengeluaran = $dataPengeluaran->pluck('total')->toArray();

    // Buat chart pengeluaran
    $chartPengeluaran = (new LarapexChart)->pieChart()
        ->setTitle('Pengeluaran Berdasarkan Kategori')
        ->setLabels($labelsPengeluaran)
        ->addData($valuesPengeluaran);

    return view('journal', [
        'chartPemasukan' => $chartPemasukan,
        'chartPengeluaran' => $chartPengeluaran,
        'kategoriPemasukan' => $kategoriPemasukan,
        'kategoriPengeluaran' => $kategoriPengeluaran,
        'pemasukans' => Pemasukan::with('kategori')->get(),
        'pengeluarans' => Pengeluaran::with('kategori')->get(),
    ]);
}



}
