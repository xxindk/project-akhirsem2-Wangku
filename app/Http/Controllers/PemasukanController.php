<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukans = Pemasukan::where('user_id', Auth::id())->get();
        return view('journal', compact('pemasukans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::where('jenis', 'pemasukan')->get();
        return view('create_pemasukan', compact('kategoris'));
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
            $data['foto'] = $request->file('foto')->store('pemasukan_foto', 'public');
        }

        Pemasukan::create($data);

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        if ($pemasukan->user_id !== Auth::id()) {
            abort(403);
        }

        $kategoris = Kategori::where('jenis', 'pemasukan')->get();
        return view('edit_pemasukan', compact('pemasukan', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        if ($pemasukan->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        $pemasukan->update($data);

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        if ($pemasukan->user_id !== Auth::id()) {
            abort(403);
        }

        $pemasukan->delete();

        return redirect()->route('journal')->with('success', 'Data pemasukan berhasil dihapus');
    }
}
