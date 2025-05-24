<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    // Tampilkan halaman sign up
    public function showSignup()
    {
        return view('signup');
    }

    // Proses sign up
    public function signupProcess(Request $request)
    {
        // Validasi input tanpa konfirmasi password
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan user baru
        User::create([
            'name' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect ke halaman sign in setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilkan halaman sign in
    public function showSignin()
    {
        return view('signin');
    }

    // Proses sign in
    public function signinProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout (opsional)

     public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
    
}
