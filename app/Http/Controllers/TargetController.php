<?php

namespace App\Http\Controllers;

use App\Models\TargetWangku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TargetController extends Controller
{
    public function index()
    {
        $targets = TargetWangku::where('user_id', Auth::id())->get();
        return view('target.index', compact('targets'));
    }

    public function create()
    {
        return view('target.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'user_id' => Auth::id(),
            'nama_target' => $validated['nama'],
            'jumlah_target' => $validated['target'],
            'jumlah_terkumpul' => $validated['jumlah_terkumpul'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('target.index')->with('success', 'Target berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $target = TargetWangku::where('user_id', Auth::id())->findOrFail($id);
        return view('target.edit', compact('target'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'target' => 'required|numeric',
            'jumlah_terkumpul' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $target = TargetWangku::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Opsional: hapus gambar lama jika perlu
            if ($target->gambar && Storage::disk('public')->exists($target->gambar)) {
                Storage::disk('public')->delete($target->gambar);
            }
            $gambarPath = $request->file('gambar')->store('targets', 'public');
        } else {
            $gambarPath = $target->gambar;
        }

        $target->update([
            'nama_target' => $validated['nama'],
            'jumlah_target' => $validated['target'],
            'jumlah_terkumpul' => $validated['jumlah_terkumpul'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('target.index')->with('success', 'Target berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $target = TargetWangku::where('user_id', Auth::id())->findOrFail($id);

        // Opsional: hapus gambar jika ada
        if ($target->gambar && Storage::disk('public')->exists($target->gambar)) {
            Storage::disk('public')->delete($target->gambar);
        }

        $target->delete();

        return redirect()->back()->with('success', 'Target berhasil dihapus.');
    }
}
