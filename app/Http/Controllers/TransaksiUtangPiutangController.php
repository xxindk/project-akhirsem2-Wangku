<?php

namespace App\Http\Controllers;

use App\Models\TransaksiUtangPiutang;
use Illuminate\Http\Request;

class TransaksiUtangPiutangController extends Controller
{
    public function index()
    {
        $data = TransaksiUtangPiutang::all();
        return view('utang-piutang.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Utang,Piutang',
            'nominal' => 'required|numeric',
            'bunga' => 'nullable|numeric',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        TransaksiUtangPiutang::create($request->all());
        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $transaksi = TransaksiUtangPiutang::findOrFail($id);
        return response()->json($transaksi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Utang,Piutang',
            'nominal' => 'required|numeric',
            'bunga' => 'nullable|numeric',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $transaksi = TransaksiUtangPiutang::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiUtangPiutang::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
