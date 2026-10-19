<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses login pengguna dan admin.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            // Memperbarui session setelah login berhasil.
            $request->session()->regenerate();

            $user = Auth::user();

            // Mengarahkan admin ke dashboard admin.
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Mengarahkan pengguna ke dashboard users.
            return redirect()->route('users.dashboard');
        }

        // Login gagal.
        return back()
            ->withErrors([
                'username' => 'Username atau password salah.',
            ])
            ->onlyInput('username');
    }
}