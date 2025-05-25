<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluarans = Pengeluaran::where('user_id', Auth::id())->get();
        return view('journal', compact('pengeluarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::where('jenis', 'pengeluaran')->get();
        return view('create_pengeluaran', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required|integer',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengeluaran_foto', 'public');
        }

        Pengeluaran::create($data);

        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $kategoris = Kategori::where('jenis', 'pengeluaran')->get();
        return view('edit_pengeluaran', compact('pengeluaran', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required|integer',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengeluaran_foto', 'public');
        }

        $pengeluaran->update($data);

        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $pengeluaran->delete();
        return redirect()->route('journal')->with('success', 'Data pengeluaran berhasil dihapus');
    }
}
