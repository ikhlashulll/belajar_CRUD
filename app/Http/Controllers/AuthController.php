<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'NIK' => 'required|min:16|unique:_t_p_k,NIK',
            'password' => 'required|min:6', // Password wajib diisi dan minimal 6 karakter
        ]);

        // Cek apakah login sebagai TPK
        if (Auth::guard('tpk')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/tpk/dashboard'); // Redirect ke dashboard TPK
        }

        // Cek apakah login sebagai Admin
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); // Redirect ke dashboard Admin
        }

        return back()->with('error', 'NIK atau Password salah!');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
