<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::all();  // Ambil semua
        return view('reminders', compact('reminders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_tagihan' => 'required|string|max:255',
            'nominal' => 'required',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        Reminder::create([
            'jenis_tagihan' => $request->jenis_tagihan,
            'nominal' => preg_replace('/[^0-9]/', '', $request->nominal),
            'jatuh_tempo' => $request->jatuh_tempo,
            'status' => $request->status,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'jenis_tagihan' => 'required|string|max:255',
            'nominal' => 'required',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $reminder->update([
            'jenis_tagihan' => $request->jenis_tagihan,
            'nominal' => preg_replace('/[^0-9]/', '', $request->nominal),
            'jatuh_tempo' => $request->jatuh_tempo,
            'status' => $request->status,
        ]);

        return redirect()->back();
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
    $reminder = Reminder::findOrFail($id);
    return response()->json($reminder);
    }

}