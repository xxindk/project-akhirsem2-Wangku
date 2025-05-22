<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
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
    $data['foto'] = $request->file('foto')->store('pemasukan_foto', 'public');
}

Pemasukan::create($data);

    return redirect()->route('home')->with('success', 'Data pemasukan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Pemasukan $pemasukan)
{
    $kategoris = Kategori::where('jenis', 'pemasukan')->get();
    return view('edit_pemasukan', compact('pemasukan', 'kategoris'));
}

public function update(Request $request, Pemasukan $pemasukan)
{
    $data = $request->validate([
        'nama' => 'required',
        'kategori_id' => 'required',
        'nominal' => 'required|integer',
        'tanggal' => 'required|date',
    ]);
    $pemasukan->update($data); // pakai objek, bukan findOrFail($id)
    return redirect()->route('journal');
}

public function destroy(Pemasukan $pemasukan)
{
    $pemasukan->delete(); // pakai objek
    return redirect()->route('journal');
}
}