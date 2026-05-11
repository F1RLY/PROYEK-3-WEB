<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Proyek;
use App\Models\Kelompok;
use App\Models\SosialMediaMahasiswa;
use App\Models\Gambar;
use App\Models\GambarProyek;

class ProfileController extends Controller
{
    // Tampilkan halaman profile
    public function index($nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        $proyekIds = Kelompok::where('mahasiswa', $mahasiswa->id)->pluck('proyek');
        $proyekList = Proyek::whereIn('id', $proyekIds)->get();
        
        $socials = [];
        if ($mahasiswa) {
            $socials = SosialMediaMahasiswa::where('mahasiswa_id', $mahasiswa->id)
                ->pluck('link', 'sosial_media_id')
                ->toArray();
        }
        
        $dataMhs = [
            'proyek' => $proyekList,
            'socials' => $socials
        ];
        
        return view('profile', compact('user', 'mahasiswa', 'dataMhs'));
    }
    
    // Halaman edit profile
    public function edit($nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        return view('profile-edit', compact('user', 'mahasiswa'));
    }
    
    // Update profile
    public function update(Request $request, $nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        $request->validate([
            'username' => 'required|string|max:255',
            'angkatan' => 'required|string|size:4',
            'kelas' => 'required|string|size:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $user->username = $request->username;
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
            $user->foto = $filename;
        }
        
        $user->save();
        
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->kelas = strtolower($request->kelas);
        $mahasiswa->save();
        
        return redirect()->route('profile', $nim)->with('success', 'Profil berhasil diupdate');
    }
    
    // Update password
    public function updatePassword(Request $request, $nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return back()->with('success', 'Password berhasil diubah');
    }
    
    public function addProyek($nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        $dosen = \App\Models\Dosen::all(); 
        
        return view('proyek-add', compact('user', 'mahasiswa', 'dosen'));
    }
    
    // SIMPAN PROYEK BARU - PERBAIKAN ERROR NULL LINK
    public function storeProyek(Request $request, $nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosenId' => 'required|exists:dosen,id',
            'link' => 'nullable|string', // Ubah validasi agar lebih fleksibel
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota' => 'required|array|min:1',
        ]);
        
        $repoCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 7);
        
        $fileLaporan = null;
        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $fileLaporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $fileLaporan);
        }
        
        $filePpt = null;
        if ($request->hasFile('file_ppt')) {
            $file = $request->file('file_ppt');
            $filePpt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $filePpt);
        }
        
        // --- PERBAIKAN LOGIKA DI SINI ---
        $proyek = new Proyek();
        $proyek->repoCode = $repoCode;
        $proyek->judul = $request->judul;
        $proyek->deskripsi = $request->deskripsi;
        
        // Memberikan nilai default '-' jika link kosong agar tidak Error 1048
        $proyek->link = $request->link ?? '-'; 
        
        $proyek->file_laporan = $fileLaporan;
        $proyek->file_ppt = $filePpt;
        $proyek->dosenId = $request->dosenId;
        $proyek->verifikasi = 0;
        $proyek->proposal = 0;
        $proyek->laporan = 0;
        $proyek->save(); // Error 1048 seharusnya hilang sekarang
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);
            
            $gambar = new Gambar();
            $gambar->lokasi = $filename;
            $gambar->imageCode = uniqid();
            $gambar->save();
            
            $gambarProyek = new GambarProyek();
            $gambarProyek->proyekId = $proyek->id;
            $gambarProyek->gambarId = $gambar->id;
            $gambarProyek->save();
        }
        
        foreach ($request->anggota as $anggotaNama) {
            $userAnggota = User::where('username', $anggotaNama)->first();
            if ($userAnggota) {
                $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                if ($mahasiswaAnggota) {
                    Kelompok::create([
                        'mahasiswa' => $mahasiswaAnggota->id,
                        'proyek' => $proyek->id,
                    ]);
                }
            }
        }
        
        $existing = Kelompok::where('mahasiswa', $mahasiswa->id)->where('proyek', $proyek->id)->first();
        if (!$existing) {
            Kelompok::create([
                'mahasiswa' => $mahasiswa->id,
                'proyek' => $proyek->id,
            ]);
        }
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil ditambahkan');
    }

    public function editProyek($nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        $proyek = Proyek::findOrFail($id);
        $dosen = \App\Models\Dosen::all();
        
        $anggotaIds = Kelompok::where('proyek', $proyek->id)->pluck('mahasiswa')->toArray();
        $anggotaNama = [];
        foreach ($anggotaIds as $anggotaId) {
            $mhs = Mahasiswa::find($anggotaId);
            if ($mhs && $mhs->user) {
                $anggotaNama[] = $mhs->user->username;
            }
        }
        
        return view('proyek-edit', compact('user', 'mahasiswa', 'proyek', 'dosen', 'anggotaNama'));
    }

    public function updateProyek(Request $request, $nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $proyek = Proyek::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosenId' => 'required|exists:dosen,id',
            'link' => 'nullable|string',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota' => 'required|array|min:1',
        ]);
        
        $proyek->judul = $request->judul;
        $proyek->deskripsi = $request->deskripsi;
        $proyek->link = $request->link ?? '-'; // Memberikan default jika diedit jadi kosong
        $proyek->dosenId = $request->dosenId;
        
        if ($request->hasFile('file_laporan')) {
            if ($proyek->file_laporan && file_exists(public_path('files/laporan/'.$proyek->file_laporan))) {
                unlink(public_path('files/laporan/'.$proyek->file_laporan));
            }
            $file = $request->file('file_laporan');
            $fileLaporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $fileLaporan);
            $proyek->file_laporan = $fileLaporan;
        }
        
        if ($request->hasFile('file_ppt')) {
            if ($proyek->file_ppt && file_exists(public_path('files/ppt/'.$proyek->file_ppt))) {
                unlink(public_path('files/ppt/'.$proyek->file_ppt));
            }
            $file = $request->file('file_ppt');
            $filePpt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $filePpt);
            $proyek->file_ppt = $filePpt;
        }
        
        if ($request->hasFile('foto')) {
            $gambarLamaRelation = GambarProyek::where('proyekId', $proyek->id)->first();
            if ($gambarLamaRelation) {
                $gambarLama = Gambar::find($gambarLamaRelation->gambarId);
                if ($gambarLama && file_exists(public_path('images/proyek/'.$gambarLama->lokasi))) {
                    unlink(public_path('images/proyek/'.$gambarLama->lokasi));
                }
                $gambarLamaRelation->delete();
                if ($gambarLama) $gambarLama->delete();
            }
            
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);
            
            $gambar = new Gambar();
            $gambar->lokasi = $filename;
            $gambar->imageCode = uniqid();
            $gambar->save();
            
            $gambarProyek = new GambarProyek();
            $gambarProyek->proyekId = $proyek->id;
            $gambarProyek->gambarId = $gambar->id;
            $gambarProyek->save();
        }
        
        $proyek->save();
        
        Kelompok::where('proyek', $proyek->id)->delete();
        foreach ($request->anggota as $anggotaNama) {
            $userAnggota = User::where('username', $anggotaNama)->first();
            if ($userAnggota) {
                $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                if ($mahasiswaAnggota) {
                    Kelompok::create([
                        'mahasiswa' => $mahasiswaAnggota->id,
                        'proyek' => $proyek->id,
                    ]);
                }
            }
        }
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil diupdate');
    }

    public function deleteProyek($nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $proyek = Proyek::findOrFail($id);
        
        if ($proyek->file_laporan && file_exists(public_path('files/laporan/'.$proyek->file_laporan))) {
            unlink(public_path('files/laporan/'.$proyek->file_laporan));
        }
        
        if ($proyek->file_ppt && file_exists(public_path('files/ppt/'.$proyek->file_ppt))) {
            unlink(public_path('files/ppt/'.$proyek->file_ppt));
        }
        
        $gambarRelation = GambarProyek::where('proyekId', $proyek->id)->first();
        if ($gambarRelation) {
            $gambar = Gambar::find($gambarRelation->gambarId);
            if ($gambar) {
                if (file_exists(public_path('images/proyek/'.$gambar->lokasi))) {
                    unlink(public_path('images/proyek/'.$gambar->lokasi));
                }
                $gambar->delete();
            }
            $gambarRelation->delete();
        }
        
        Kelompok::where('proyek', $proyek->id)->delete();
        $proyek->delete();
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil dihapus');
    }
}