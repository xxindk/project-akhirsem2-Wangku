<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', Auth::id())->get();
        return view('reminders', compact('reminders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_tagihan' => 'required|string|max:255',
            'nominal' => 'required',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['nominal'] = preg_replace('/[^0-9]/', '', $validated['nominal']);

        Reminder::create($validated);

        return redirect()->back()->with('success', 'Reminder berhasil ditambahkan');
    }

    public function update(Request $request, Reminder $reminder)
    {
        if ($reminder->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jenis_tagihan' => 'required|string|max:255',
            'nominal' => 'required',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $validated['nominal'] = preg_replace('/[^0-9]/', '', $validated['nominal']);

        $reminder->update($validated);

        return redirect()->back()->with('success', 'Reminder berhasil diperbarui');
    }

    public function destroy(Reminder $reminder)
    {
        if ($reminder->user_id !== Auth::id()) {
            abort(403);
        }

        $reminder->delete();
        return redirect()->back()->with('success', 'Reminder berhasil dihapus');
    }

    public function edit($id)
    {
        $reminder = Reminder::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($reminder);
    }
}
