<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    'foto' => 'nullable|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);
$fotoPath = null;
if ($request->hasFile('foto')) {
    $data['foto'] = $request->file('foto')->store('pengeluaran_foto', 'public');
}

Pengeluaran::create($data);
return redirect()->route('home')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
{
    $kategoris = Kategori::where('jenis', 'pengeluaran')->get();
    return view('edit_pengeluaran', compact('pengeluaran', 'kategoris'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $data = $request->validate([
        'nama' => 'required',
        'kategori_id' => 'required',
        'nominal' => 'required|integer',
        'tanggal' => 'required|date',
         'foto' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('pengeluaran_foto', 'public');
    }
        $pengeluaran->update($data);

    return redirect()->route('home')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
                    $pengeluaran->delete();
    return redirect()->route('journal');
    }
}
