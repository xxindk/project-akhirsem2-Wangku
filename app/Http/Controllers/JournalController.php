<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
        $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')->get();

     $pemasukan = DB::table('pemasukans')
    ->join('kategoris', 'pemasukans.kategori_id', '=', 'kategoris.id')
    ->where('pemasukans.user_id', Auth::id())
    ->select('kategoris.nama as kategori', DB::raw('SUM(pemasukans.nominal) as total'))
    ->groupBy('pemasukans.kategori_id', 'kategoris.nama')
    ->get();



        $pengeluaran = DB::table('pengeluarans')
            ->join('kategoris', 'pengeluarans.kategori_id', '=', 'kategoris.id')
             ->where('pengeluarans.user_id', Auth::id())
            ->select('kategoris.nama as kategori', DB::raw('SUM(pengeluarans.nominal) as total'))
            ->groupBy('pengeluarans.kategori_id', 'kategoris.nama')
            ->get();

        return view('journal', [
            'chartPemasukanData' => [
                'labels' => $pemasukan->pluck('kategori'),
                'data' => $pemasukan->pluck('total'),
            ],
            'chartPengeluaranData' => [
                'labels' => $pengeluaran->pluck('kategori'),
                'data' => $pengeluaran->pluck('total'),
            ],
            'labelsPemasukan' => $pemasukan->pluck('kategori')->toArray(),
            'valuesPemasukan' => $pemasukan->pluck('total')->toArray(),
            'labelsPengeluaran' => $pengeluaran->pluck('kategori')->toArray(),
            'valuesPengeluaran' => $pengeluaran->pluck('total')->toArray(),
            'kategoriPemasukan' => $kategoriPemasukan,
            'kategoriPengeluaran' => $kategoriPengeluaran,
'pemasukans' => Pemasukan::with('kategori')->where('user_id', Auth::id())->get(),
'pengeluarans' => Pengeluaran::with('kategori')->where('user_id', Auth::id())->get(),

            'totalPemasukan' => $pemasukan->sum('total'),
            'totalPengeluaran' => $pengeluaran->sum('total'),
        ]);
    }

    public function storePemasukan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto') 
            ? $request->file('foto')->store('pemasukan_fotos', 'public')
            : null;

        Pemasukan::create([
            ...$validated,
            'foto' => $fotoPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil disimpan');
    }

    public function storePengeluaran(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto') 
            ? $request->file('foto')->store('pengeluaran_fotos', 'public')
            : null;

        Pengeluaran::create([
            ...$validated,
            'foto' => $fotoPath,
            'user_id' => Auth::id(),
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
        if ($pemasukan->user_id !== Auth::id()) {
    abort(403);
}

    }

    public function destroyPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        if ($pengeluaran->foto) {
            Storage::disk('public')->delete($pengeluaran->foto);
        }
        $pengeluaran->delete();

        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil dihapus');
        if ($pemasukan->user_id !== Auth::id()) {
    abort(403);
}

    }

    public function editPemasukan($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')->get();
        return view('edit_pemasukan', compact('pemasukan', 'kategoriPemasukan'));
    }

    public function updatePemasukan(Request $request, $id)
    {
        $validated = $request->validate([
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
            ...$validated,
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
        $validated = $request->validate([
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
            ...$validated,
            'foto' => $pengeluaran->foto,
        ]);

        return redirect()->route('journal')->with('success', 'Pengeluaran berhasil diperbarui');
    }
}
