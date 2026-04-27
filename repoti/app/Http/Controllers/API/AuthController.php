<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal'
            ]);
        }
        
        $token = $user->createToken('auth')->plainTextToken;
        
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'kode' => $user->kode,
                'foto' => $user->foto,
            ],
            'token' => $token
        ]);
    }
    
    // Tambahkan method ini untuk profile
    public function profile(Request $request)
    {
        $user = $request->user();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'mahasiswa' => $mahasiswa
            ]
        ]);
    }
    public function updateProfile(Request $request)
{
    $user = $request->user();
    $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
    
    $request->validate([
        'username' => 'sometimes|string|max:255',
        'angkatan' => 'sometimes|string|size:4',
        'kelas' => 'sometimes|string|size:1',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);
    
    // Update username
    if ($request->has('username')) {
        $user->username = $request->username;
    }
    
    // Upload foto
    if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($user->foto && file_exists(public_path('image/'.$user->foto))) {
            unlink(public_path('image/'.$user->foto));
        }
        
        $file = $request->file('foto');
        $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image'), $filename);
        $user->foto = $filename;
    }
    
    $user->save();
    
    // Update mahasiswa
    if ($request->has('angkatan')) {
        $mahasiswa->angkatan = $request->angkatan;
    }
    if ($request->has('kelas')) {
        $mahasiswa->kelas = strtolower($request->kelas);
    }
    $mahasiswa->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Profil berhasil diupdate',
        'data' => [
            'user' => $user,
            'mahasiswa' => $mahasiswa
        ]
    ]);
    }

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'nim' => 'required|string|unique:users,kode',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'angkatan' => 'required|string|size:4',
        'kelas' => 'required|string|size:1',
    ]);

    $user = User::create([
        'username' => $request->username,
        'kode' => $request->nim,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'mahasiswa',
    ]);

    Mahasiswa::create([
        'userID' => $user->id,
        'angkatan' => $request->angkatan,
        'kelas' => strtolower($request->kelas),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil',
        'user' => $user
    ]);
}
}

    