<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }
    
   // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            }

            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
    
    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }
    
    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'angkatan' => 'required|string|size:4',
            'kelas' => 'required|string|size:1',
            'nim' => 'required|string|unique:users,kode',
        ]);
        
        // Buat user
        $user = User::create([
            'username' => $request->username,
            'kode' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);
        
        // Buat data mahasiswa
        Mahasiswa::create([
            'userID' => $user->id,
            'angkatan' => $request->angkatan,
            'kelas' => strtolower($request->kelas),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Login otomatis
        Auth::login($user);
        
        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang.');
    }
    
    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}