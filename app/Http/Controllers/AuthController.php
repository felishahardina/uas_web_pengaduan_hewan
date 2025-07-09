<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Gunakan Hash facade

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form registrasi.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi user baru.
     */
    public function register(Request $request)
    {
        // Validasi input yang lebih baik
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Membuat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Gunakan Hash::make() yang lebih modern
            'role' => 'user' // Default role untuk registrasi adalah 'user'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    /**
     * Menampilkan halaman form login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses otentikasi pengguna.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba otentikasi user
        if (Auth::attempt($credentials)) {
            // 3. Jika otentikasi berhasil, buat ulang session untuk keamanan
            $request->session()->regenerate();

            // 4. Cek role user dan arahkan ke dashboard yang sesuai
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Arahkan user biasa ke dashboard mereka
            return redirect()->intended(route('user.dashboard'));
        }

        // 5. Jika otentikasi gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
