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
        
        // Ambil proyek yang diikuti mahasiswa - PERBAIKAN
        $proyekIds = Kelompok::where('mahasiswa', $mahasiswa->id)->pluck('proyek');
        $proyekList = Proyek::whereIn('id', $proyekIds)->get();
        
        // Ambil sosial media
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
        
        // Update user
        $user->username = $request->username;
        
        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
            $user->foto = $filename;
        }
        
        $user->save();
        
        // Update mahasiswa
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
    
    // Halaman tambah proyek
    public function addProyek($nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        $dosen = \App\Models\Dosen::all(); // Ambil semua dosen
        
        return view('proyek-add', compact('user', 'mahasiswa', 'dosen'));
    }
    
    // Simpan proyek baru
    public function storeProyek(Request $request, $nim)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosenId' => 'required|exists:dosen,id',
            'link' => 'nullable|url',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota' => 'required|array|min:1',
        ]);
        
        // Buat kode unik
        $repoCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 7);
        
        // Upload laporan
        $fileLaporan = null;
        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $fileLaporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $fileLaporan);
        }
        
        // Upload PPT
        $filePpt = null;
        if ($request->hasFile('file_ppt')) {
            $file = $request->file('file_ppt');
            $filePpt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $filePpt);
        }
        
        // Buat proyek
        $proyek = new Proyek();
        $proyek->repoCode = $repoCode;
        $proyek->judul = $request->judul;
        $proyek->deskripsi = $request->deskripsi;
        $proyek->link = $request->link;
        $proyek->file_laporan = $fileLaporan;
        $proyek->file_ppt = $filePpt;
        $proyek->dosenId = $request->dosenId;
        $proyek->verifikasi = 0;
        $proyek->proposal = 0;
        $proyek->laporan = 0;
        $proyek->created_at = now();
        $proyek->updated_at = now();
        $proyek->save();
        
        // Upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);
            
            $gambar = new Gambar();
            $gambar->lokasi = $filename;
            $gambar->imageCode = uniqid();
            $gambar->created_at = now();
            $gambar->updated_at = now();
            $gambar->save();
            
            $gambarProyek = new GambarProyek();
            $gambarProyek->proyekId = $proyek->id;
            $gambarProyek->gambarId = $gambar->id;
            $gambarProyek->created_at = now();
            $gambarProyek->updated_at = now();
            $gambarProyek->save();
        }
        
        // Hubungkan anggota kelompok
        foreach ($request->anggota as $anggotaNama) {
            // Cari user berdasarkan nama
            $userAnggota = User::where('username', $anggotaNama)->first();
            if ($userAnggota) {
                $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                if ($mahasiswaAnggota) {
                    Kelompok::create([
                        'mahasiswa' => $mahasiswaAnggota->id,
                        'proyek' => $proyek->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        
        // Pastikan pembuat proyek masuk sebagai anggota
        $existing = Kelompok::where('mahasiswa', $mahasiswa->id)->where('proyek', $proyek->id)->first();
        if (!$existing) {
            Kelompok::create([
                'mahasiswa' => $mahasiswa->id,
                'proyek' => $proyek->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil ditambahkan');
    }

    // Halaman edit proyek
    public function editProyek($nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        $proyek = Proyek::findOrFail($id);
        $dosen = \App\Models\Dosen::all();
        
        // Ambil anggota kelompok
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

    // Update proyek
    public function updateProyek(Request $request, $nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();
        $proyek = Proyek::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosenId' => 'required|exists:dosen,id',
            'link' => 'nullable|url',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota' => 'required|array|min:1',
        ]);
        
        // Update data proyek
        $proyek->judul = $request->judul;
        $proyek->deskripsi = $request->deskripsi;
        $proyek->link = $request->link;
        $proyek->dosenId = $request->dosenId;
        
        // Upload laporan baru jika ada
        if ($request->hasFile('file_laporan')) {
            // Hapus file lama
            if ($proyek->file_laporan && file_exists(public_path('files/laporan/'.$proyek->file_laporan))) {
                unlink(public_path('files/laporan/'.$proyek->file_laporan));
            }
            $file = $request->file('file_laporan');
            $fileLaporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $fileLaporan);
            $proyek->file_laporan = $fileLaporan;
        }
        
        // Upload PPT baru jika ada
        if ($request->hasFile('file_ppt')) {
            if ($proyek->file_ppt && file_exists(public_path('files/ppt/'.$proyek->file_ppt))) {
                unlink(public_path('files/ppt/'.$proyek->file_ppt));
            }
            $file = $request->file('file_ppt');
            $filePpt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $filePpt);
            $proyek->file_ppt = $filePpt;
        }
        
        // Upload gambar baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus gambar lama
            $gambarLama = $proyek->gambars->first();
            if ($gambarLama && file_exists(public_path('images/proyek/'.$gambarLama->lokasi))) {
                unlink(public_path('images/proyek/'.$gambarLama->lokasi));
                GambarProyek::where('proyekId', $proyek->id)->delete();
                $gambarLama->delete();
            }
            
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);
            
            $gambar = new Gambar();
            $gambar->lokasi = $filename;
            $gambar->imageCode = uniqid();
            $gambar->created_at = now();
            $gambar->updated_at = now();
            $gambar->save();
            
            $gambarProyek = new GambarProyek();
            $gambarProyek->proyekId = $proyek->id;
            $gambarProyek->gambarId = $gambar->id;
            $gambarProyek->created_at = now();
            $gambarProyek->updated_at = now();
            $gambarProyek->save();
        }
        
        $proyek->save();
        
        // Update anggota kelompok
        // Hapus semua anggota lama
        Kelompok::where('proyek', $proyek->id)->delete();
        
        // Tambah anggota baru
        foreach ($request->anggota as $anggotaNama) {
            $userAnggota = User::where('username', $anggotaNama)->first();
            if ($userAnggota) {
                $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                if ($mahasiswaAnggota) {
                    Kelompok::create([
                        'mahasiswa' => $mahasiswaAnggota->id,
                        'proyek' => $proyek->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil diupdate');
    }

    // Hapus proyek
    public function deleteProyek($nim, $id)
    {
        $user = User::where('kode', $nim)->firstOrFail();
        $proyek = Proyek::findOrFail($id);
        
        // Hapus file laporan
        if ($proyek->file_laporan && file_exists(public_path('files/laporan/'.$proyek->file_laporan))) {
            unlink(public_path('files/laporan/'.$proyek->file_laporan));
        }
        
        // Hapus file PPT
        if ($proyek->file_ppt && file_exists(public_path('files/ppt/'.$proyek->file_ppt))) {
            unlink(public_path('files/ppt/'.$proyek->file_ppt));
        }
        
        // Hapus gambar
        $gambar = $proyek->gambars->first();
        if ($gambar) {
            if (file_exists(public_path('images/proyek/'.$gambar->lokasi))) {
                unlink(public_path('images/proyek/'.$gambar->lokasi));
            }
            GambarProyek::where('proyekId', $proyek->id)->delete();
            $gambar->delete();
        }
        
        // Hapus anggota kelompok
        Kelompok::where('proyek', $proyek->id)->delete();
        
        // Hapus proyek
        $proyek->delete();
        
        return redirect()->route('profile', $nim)->with('success', 'Proyek berhasil dihapus');
    }
}