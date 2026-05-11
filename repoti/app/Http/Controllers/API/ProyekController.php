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
use App\Models\VideoProyek;
use Illuminate\Support\Str;

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
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'dosenId'       => 'required|exists:dosen,id',
            'link'          => 'nullable|url',
            'file_laporan'  => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt'      => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'anggota'       => 'required',
            // Video
            'video_files'   => 'nullable|array',
            'video_files.*' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:102400',
            'video_urls'    => 'nullable|array',
            'video_urls.*'  => 'nullable|url',
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
            'repoCode'    => $repoCode,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'link'        => $request->link ?? '',
            'file_laporan'=> $fileLaporan,
            'file_ppt'    => $filePpt,
            'dosenId'     => $request->dosenId,
            'verifikasi'  => 0,
            'proposal'    => 0,
            'laporan'     => 0,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/proyek'), $filename);

            $gambar = Gambar::create([
                'lokasi'     => $filename,
                'imageCode'  => uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            GambarProyek::create([
                'proyekId'   => $proyek->id,
                'gambarId'   => $gambar->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Handle anggota kelompok
        $anggotaList = [];
        if (is_array($request->anggota)) {
            $anggotaList = $request->anggota;
        } else {
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
                    $existing = Kelompok::where('mahasiswa', $mahasiswaAnggota->id)
                        ->where('proyek', $proyek->id)->first();
                    if (!$existing) {
                        Kelompok::create([
                            'mahasiswa'  => $mahasiswaAnggota->id,
                            'nama'       => $userAnggota->username,
                            'proyek'     => $proyek->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            } else {
                Kelompok::create([
                    'mahasiswa'  => null,
                    'nama'       => $anggotaNama,
                    'proyek'     => $proyek->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Pastikan uploader sendiri masuk kelompok
        $existing = Kelompok::where('mahasiswa', $mahasiswa->id)
            ->where('proyek', $proyek->id)->first();
        if (!$existing) {
            Kelompok::create([
                'mahasiswa'  => $mahasiswa->id,
                'nama'       => $user->username,
                'proyek'     => $proyek->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Upload video files
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files/video'), $filename);
                VideoProyek::create([
                    'videoCode'  => Str::uuid(),
                    'lokasi'     => $filename,
                    'proyekId'   => $proyek->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Simpan video URLs (YouTube / eksternal)
        if ($request->video_urls) {
            foreach ($request->video_urls as $url) {
                if (!empty($url)) {
                    VideoProyek::create([
                        'videoCode'  => Str::uuid(),
                        'lokasi'     => $url,
                        'proyekId'   => $proyek->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Proyek berhasil diupload',
            'data'    => $proyek
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

        $proyekIds = Kelompok::where('mahasiswa', $mahasiswa->id)->pluck('proyek');

        $proyekList = Proyek::whereIn('id', $proyekIds)
            ->with(['dosen', 'gambars', 'kelompok.anggota.user', 'videos'])
            ->get();

        return response()->json(['success' => true, 'data' => $proyekList]);
    }

    // Get proyek by ID
    public function show($id)
    {
        $proyek = Proyek::with(['dosen', 'gambars', 'kelompok.anggota.user', 'videos'])
            ->find($id);

        if (!$proyek) {
            return response()->json(['success' => false, 'message' => 'Proyek tidak ditemukan']);
        }

        return response()->json(['success' => true, 'data' => $proyek]);
    }

    // Hapus proyek
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();

        $proyek = Proyek::find($id);

        if (!$proyek) {
            return response()->json(['success' => false, 'message' => 'Proyek tidak ditemukan'], 404);
        }

        $isAnggota = Kelompok::where('proyek', $id)
            ->where('mahasiswa', $mahasiswa?->id)
            ->exists();

        if (!$isAnggota) {
            return response()->json(['success' => false, 'message' => 'Tidak diizinkan menghapus proyek ini'], 403);
        }

        // Hapus file laporan
        if ($proyek->file_laporan) {
            $path = public_path('files/laporan/' . $proyek->file_laporan);
            if (file_exists($path)) unlink($path);
        }

        // Hapus file ppt
        if ($proyek->file_ppt) {
            $path = public_path('files/ppt/' . $proyek->file_ppt);
            if (file_exists($path)) unlink($path);
        }

        // Hapus gambar
        foreach ($proyek->gambars as $gambar) {
            $path = public_path('images/' . $gambar->lokasi);
            if (file_exists($path)) unlink($path);
            GambarProyek::where('gambarId', $gambar->id)->delete();
            $gambar->delete();
        }

        // Hapus video files (bukan URL)
        foreach ($proyek->videos as $video) {
            if (!filter_var($video->lokasi, FILTER_VALIDATE_URL)) {
                $path = public_path('files/video/' . $video->lokasi);
                if (file_exists($path)) unlink($path);
            }
            $video->delete();
        }

        // Hapus kelompok
        Kelompok::where('proyek', $id)->delete();

        // Hapus proyek
        $proyek->delete();

        return response()->json(['success' => true, 'message' => 'Proyek berhasil dihapus']);
    }

    // Update proyek
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $mahasiswa = Mahasiswa::where('userID', $user->id)->first();

        $proyek = Proyek::find($id);

        if (!$proyek) {
            return response()->json(['success' => false, 'message' => 'Proyek tidak ditemukan'], 404);
        }

        $isAnggota = Kelompok::where('proyek', $id)
            ->where('mahasiswa', $mahasiswa?->id)
            ->exists();

        if (!$isAnggota) {
            return response()->json(['success' => false, 'message' => 'Tidak diizinkan mengedit proyek ini'], 403);
        }

        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'dosenId'           => 'required|exists:dosen,id',
            'link'              => 'nullable|url',
            'file_laporan'      => 'nullable|file|mimes:pdf|max:10240',
            'file_ppt'          => 'nullable|file|mimes:ppt,pptx|max:10240',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_files'       => 'nullable|array',
            'video_files.*'     => 'nullable|file|mimes:mp4,mov,avi,mkv|max:102400',
            'video_urls'        => 'nullable|array',
            'video_urls.*'      => 'nullable|url',
            'hapus_video_ids'   => 'nullable|array',
            'hapus_video_ids.*' => 'nullable|integer',
        ]);

        // Update file laporan
        if ($request->hasFile('file_laporan')) {
            if ($proyek->file_laporan) {
                $old = public_path('files/laporan/' . $proyek->file_laporan);
                if (file_exists($old)) unlink($old);
            }
            $file = $request->file('file_laporan');
            $proyek->file_laporan = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/laporan'), $proyek->file_laporan);
        }

        // Update file ppt
        if ($request->hasFile('file_ppt')) {
            if ($proyek->file_ppt) {
                $old = public_path('files/ppt/' . $proyek->file_ppt);
                if (file_exists($old)) unlink($old);
            }
            $file = $request->file('file_ppt');
            $proyek->file_ppt = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/ppt'), $proyek->file_ppt);
        }

        // Update foto
        if ($request->hasFile('foto')) {
            foreach ($proyek->gambars as $gambar) {
                $old = public_path('images/' . $gambar->lokasi);
                if (file_exists($old)) unlink($old);
                GambarProyek::where('gambarId', $gambar->id)->delete();
                $gambar->delete();
            }
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $gambar = Gambar::create([
                'lokasi'     => $filename,
                'imageCode'  => uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            GambarProyek::create([
                'proyekId'   => $proyek->id,
                'gambarId'   => $gambar->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Update anggota
        if ($request->anggota) {
            $anggotaList = json_decode($request->anggota, true) ?? [$request->anggota];
            Kelompok::where('proyek', $id)->delete();

            foreach ($anggotaList as $anggotaNama) {
                $userAnggota = User::where('username', $anggotaNama)->first();
                if ($userAnggota) {
                    $mahasiswaAnggota = Mahasiswa::where('userID', $userAnggota->id)->first();
                    if ($mahasiswaAnggota) {
                        Kelompok::create([
                            'mahasiswa'  => $mahasiswaAnggota->id,
                            'nama'       => $userAnggota->username,
                            'proyek'     => $id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } else {
                    Kelompok::create([
                        'mahasiswa'  => null,
                        'nama'       => $anggotaNama,
                        'proyek'     => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Pastikan uploader tetap ada
            $existing = Kelompok::where('mahasiswa', $mahasiswa->id)->where('proyek', $id)->first();
            if (!$existing) {
                Kelompok::create([
                    'mahasiswa'  => $mahasiswa->id,
                    'nama'       => $user->username,
                    'proyek'     => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Hapus video yang dipilih
        if ($request->hapus_video_ids) {
            foreach ($request->hapus_video_ids as $videoId) {
                $video = VideoProyek::find($videoId);
                if ($video && $video->proyekId == $id) {
                    if (!filter_var($video->lokasi, FILTER_VALIDATE_URL)) {
                        $path = public_path('files/video/' . $video->lokasi);
                        if (file_exists($path)) unlink($path);
                    }
                    $video->delete();
                }
            }
        }

        // Tambah video files baru
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files/video'), $filename);
                VideoProyek::create([
                    'videoCode'  => Str::uuid(),
                    'lokasi'     => $filename,
                    'proyekId'   => $proyek->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Tambah video URLs baru
        if ($request->video_urls) {
            foreach ($request->video_urls as $url) {
                if (!empty($url)) {
                    VideoProyek::create([
                        'videoCode'  => Str::uuid(),
                        'lokasi'     => $url,
                        'proyekId'   => $proyek->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $proyek->judul      = $request->judul;
        $proyek->deskripsi  = $request->deskripsi;
        $proyek->link       = $request->link ?? '';
        $proyek->dosenId    = $request->dosenId;
        $proyek->verifikasi = 0;
        $proyek->updated_at = now();
        $proyek->save();

        return response()->json([
            'success' => true,
            'message' => 'Proyek berhasil diupdate',
            'data'    => $proyek
        ]);
    }
}