<?php

namespace App\Http\Controllers;

use App\Models\TransaksiUtangPiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiUtangPiutangController extends Controller
{
    public function index()
{
    $data = TransaksiUtangPiutang::where('user_id', Auth::id())->get();
    return view('utang-piutang.index', compact('data'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:Utang,Piutang',
            'nominal' => 'required|numeric',
            'bunga' => 'nullable|numeric',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        TransaksiUtangPiutang::create([
            'user_id' => Auth::id(),
            'jenis' => $validated['jenis'],
            'nominal' => $validated['nominal'],
            'bunga' => $validated['bunga'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $transaksi = TransaksiUtangPiutang::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($transaksi);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:Utang,Piutang',
            'nominal' => 'required|numeric',
            'bunga' => 'nullable|numeric',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $transaksi = TransaksiUtangPiutang::where('user_id', Auth::id())->findOrFail($id);

        $transaksi->update([
            'jenis' => $validated['jenis'],
            'nominal' => $validated['nominal'],
            'bunga' => $validated['bunga'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiUtangPiutang::where('user_id', Auth::id())->findOrFail($id);
        $transaksi->delete();

        return redirect()->route('utang-piutang.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
