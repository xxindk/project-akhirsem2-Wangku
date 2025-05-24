<?php

namespace App\Http\Controllers;

use App\Models\TargetWangku;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function index()
    {
        $targets = TargetWangku::all();
        return view('target.index', compact('targets'));
    }

    public function create()
    {
        return view('target.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'target' => 'required|numeric',
            'jumlah_terkumpul' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('targets', 'public');
        }

        TargetWangku::create([
            'nama_target' => $request->nama,
            'jumlah_target' => $request->target,
            'jumlah_terkumpul' => $request->jumlah_terkumpul,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('target.index')->with('success', 'Target berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $target = TargetWangku::findOrFail($id);
        return view('target.edit', compact('target'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'target' => 'required|numeric',
            'jumlah_terkumpul' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $target = TargetWangku::findOrFail($id);

        $gambarPath = $target->gambar;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('targets', 'public');
        }

        $target->update([
            'nama_target' => $request->nama,
            'jumlah_target' => $request->target,
            'jumlah_terkumpul' => $request->jumlah_terkumpul,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('target.index')->with('success', 'Target berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $target = TargetWangku::findOrFail($id);
        $target->delete();

        return redirect()->back()->with('success', 'Target berhasil dihapus.');
    }
}
