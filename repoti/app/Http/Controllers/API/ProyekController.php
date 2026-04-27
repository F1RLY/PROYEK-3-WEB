<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Kelompok;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Gambar;
use App\Models\GambarProyek;

class ProyekController extends Controller
{
    // Get all projects
    public function index()
    {
        $proyek = Proyek::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $proyek
        ]);
    }
    
    // Get all dosen (untuk dropdown)
    public function getDosen()
    {
        $dosen = Dosen::all();
        return response()->json(['success' => true, 'data' => $dosen]);
    }
    
    // Store proyek baru
    public function store(Request $request)
    {
        $user = $request->user();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan. Silakan lengkapi profil Anda.'
            ], 400);
        }
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosenId' => 'required|exists:dosen,id',
            'link' => 'nullable|url',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota' => 'required',  // Diubah dari array
        ]);
        
        // Generate unique code
        $repoCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 7);
        
        // Upload file laporan
        $fileLaporan = null;
        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $fileLaporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $fileLaporan);
        }
        
        // Upload file ppt
        $filePpt = null;
        if ($request->hasFile('file_ppt')) {
            $file = $request->file('file_ppt');
            $filePpt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $filePpt);
        }
        
        // Create proyek
        $proyek = Proyek::create([
            'repoCode' => $repoCode,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link ?? '',
            'file_laporan' => $fileLaporan,
            'file_ppt' => $filePpt,
            'dosenId' => $request->dosenId,
            'verifikasi' => 0,
            'proposal' => 0,
            'laporan' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);
            
            $gambar = Gambar::create([
                'lokasi' => $filename,
                'imageCode' => uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            GambarProyek::create([
                'proyekId' => $proyek->id,
                'gambarId' => $gambar->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Handle anggota kelompok (menerima berbagai format)
        $anggotaList = [];
        if (is_array($request->anggota)) {
            $anggotaList = $request->anggota;
        } else {
            // Coba parse JSON
            $decoded = json_decode($request->anggota, true);
            if (is_array($decoded)) {
                $anggotaList = $decoded;
            } else {
                $anggotaList = [$request->anggota];
            }
        }
        
        foreach ($anggotaList as $anggotaNama) {
            $userAnggota = User::where('username', $anggotaNama)->first();
            if ($userAnggota) {
                $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                if ($mahasiswaAnggota) {
                    $existing = Kelompok::where('mahasiswa', $mahasiswaAnggota->id)->where('proyek', $proyek->id)->first();
                    if (!$existing) {
                        Kelompok::create([
                            'mahasiswa' => $mahasiswaAnggota->id,
                            'proyek' => $proyek->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        
        // Pastikan user sendiri sebagai anggota
        $existing = Kelompok::where('mahasiswa', $mahasiswa->id)->where('proyek', $proyek->id)->first();
        if (!$existing) {
            Kelompok::create([
                'mahasiswa' => $mahasiswa->id,
                'proyek' => $proyek->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Proyek berhasil diupload',
            'data' => $proyek
        ]);
    }
    
    // Get proyek milik user yang login
    public function userProyek(Request $request)
    {
        $user = $request->user();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        if (!$mahasiswa) {
            return response()->json(['success' => true, 'data' => []]);
        }
        
        // Ambil ID proyek dari tabel kelompok
        $proyekIds = Kelompok::where('mahasiswa', $mahasiswa->id)->pluck('proyek');
        
        // Ambil data lengkap proyek beserta relasi dosen dan kelompok
        $proyekList = Proyek::whereIn('id', $proyekIds)
            ->with(['dosen', 'kelompok.mahasiswa.user'])
            ->get();
        
        return response()->json(['success' => true, 'data' => $proyekList]);
    }
    
    // Get proyek by ID
    public function show($id)
    {
        $proyek = Proyek::find($id);
        
        if (!$proyek) {
            return response()->json(['success' => false, 'message' => 'Proyek tidak ditemukan']);
        }
        
        return response()->json(['success' => true, 'data' => $proyek]);
    }
}