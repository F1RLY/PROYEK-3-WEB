<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\mahasiswaController;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('page.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            session(["user-role" => $user->role]);
            session(["login" => true]); 

            if ($user->role === 'admin') {
                return redirect("/admin");
            }
            if ( $user->role === 'mahasiswa' ){
                $mahasiswa = mahasiswaController::getMahasiswaFromUserId($user->id);
                session(["account" => $mahasiswa]);
            }

            return redirect()->intended('/');
        }

        // Kirim pesan error ke view
        return back()->with('error', ' Username atau password salah!')->onlyInput('username');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('page.register'); 
    }

    public function register(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|min:7|max:15|unique:users,kode', 
            'email' => 'required|string|email|max:255|unique:users,email', 
            'password' => 'required|string|min:6|confirmed', 
            'angkatan' => 'required|integer|digits:4', 
            'kelas' => 'required|string|max:5',
        ], [
            'required' => ':attribute wajib diisi.',
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nim.size' => 'NIM harus :size karakter.',
            'angkatan.digits' => 'Angkatan harus :digits digit tahun.',
            'kelas.max' => 'Kelas maksimal :max karakter.'
        ]);

        $mahasiswaData = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => $request->password,
            'angkatan' => $request->angkatan,
            'kelas' => $request->kelas,
        ];

        try {
            mahasiswaController::addMahasiswa($mahasiswaData);
            
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan NIM/Email.');

        } catch (\Exception $e) {
        // Hapus dd($e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Registrasi gagal. Terjadi kesalahan server.');
        }
    }
}
