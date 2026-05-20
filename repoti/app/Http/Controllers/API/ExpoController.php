<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expo;
use App\Models\Penilaian;

class ExpoController extends Controller
{
    // List expo aktif
    public function index()
    {
        $expos = Expo::withCount('proyeks')
            ->where('status', 'active')
            ->latest()
            ->get()
            ->map(function ($expo) {
                return [
                    'id'              => $expo->id,
                    'nama'            => $expo->nama,
                    'deskripsi'       => $expo->deskripsi,
                    'status'          => $expo->status,
                    'tanggal_mulai'   => $expo->tanggal_mulai,
                    'tanggal_selesai' => $expo->tanggal_selesai,
                    'total_proyek'    => $expo->proyeks_count,
                ];
            });

        return response()->json(['success' => true, 'data' => $expos]);
    }

    // Detail expo + daftar proyek + rata-rata nilai tiap proyek
    public function show($id)
    {
        $expo = Expo::with([
            'proyeks.gambars',
            'proyeks.kelompok.anggota.user',
            'proyeks.dosen',
        ])->findOrFail($id);

        if (!in_array($expo->status, ['active', 'ended'])) {
            return response()->json(['success' => false, 'message' => 'Expo tidak tersedia'], 404);
        }

        $proyeks = $expo->proyeks->map(function ($proyek) use ($expo) {
            // Rata-rata nilai proyek ini di expo ini
            $penilaian = Penilaian::where('expo_id', $expo->id)
                ->where('proyek_id', $proyek->id);

            $rataRata     = $penilaian->avg('nilai');
            $jumlahPenilai = $penilaian->count();

            // Anggota
            $anggota = $proyek->kelompok->map(function ($k) {
                return $k->nama ?? $k->anggota?->user?->username ?? 'Unknown';
            });

            // Gambar
            $gambar = $proyek->gambars->first()?->lokasi;

            return [
                'id'             => $proyek->id,
                'judul'          => $proyek->judul,
                'deskripsi'      => $proyek->deskripsi,
                'repoCode'       => $proyek->repoCode,
                'link'           => $proyek->link,
                'dosen'          => $proyek->dosen?->nama,
                'gambar'         => $gambar,
                'anggota'        => $anggota,
                'rata_rata'      => $rataRata ? round($rataRata, 1) : null,
                'jumlah_penilai' => $jumlahPenilai,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'id'              => $expo->id,
                'nama'            => $expo->nama,
                'deskripsi'       => $expo->deskripsi,
                'status'          => $expo->status,
                'tanggal_mulai'   => $expo->tanggal_mulai,
                'tanggal_selesai' => $expo->tanggal_selesai,
                'proyeks'         => $proyeks,
            ],
        ]);
    }
    
    // Submit penilaian (login → ambil dari akun, guest → isi manual)
    public function nilaiStore(Request $request, $expoId, $proyekId)
    {
        $expo = Expo::findOrFail($expoId);

        if ($expo->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Expo tidak sedang berlangsung',
            ], 400);
        }

        // Cek proyek ada di expo ini
        $proyekAda = $expo->proyeks()->where('proyek_id', $proyekId)->exists();
        if (!$proyekAda) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan di expo ini',
            ], 404);
        }

        // Deteksi login atau guest
        $user = null;
        $token = $request->bearerToken();
        if ($token) {
            $user = \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->tokenable;
        }

        if ($user) {
            // Mobile: ambil dari akun login
            $namaPenilai  = $user->username;
            $emailPenilai = $user->email;
        } else {
            // Web: validasi input manual
            $request->validate([
                'nama_penilai'  => 'required|string|max:255',
                'email_penilai' => 'required|email|max:255',
                'nilai'         => 'required|integer|min:1|max:10',
            ]);
            $namaPenilai  = $request->nama_penilai;
            $emailPenilai = $request->email_penilai;
        }

        $request->validate([
            'nilai' => 'required|integer|min:1|max:10',
        ]);

        // Cek sudah menilai proyek ini di expo ini
        $sudahNilai = Penilaian::where('expo_id', $expoId)
            ->where('proyek_id', $proyekId)
            ->where('email_penilai', $emailPenilai)
            ->exists();

        if ($sudahNilai) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan penilaian untuk proyek ini',
            ], 400);
        }

        Penilaian::create([
            'expo_id'       => $expoId,
            'proyek_id'     => $proyekId,
            'nilai'         => $request->nilai,
            'nama_penilai'  => $namaPenilai,
            'email_penilai' => $emailPenilai,
            'penilai_ip'    => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil dikirim!',
        ]);
    }

    // Hasil/ranking expo (untuk expo yang sudah ended)
    public function hasil($id)
    {
        $expo = Expo::with('proyeks')->findOrFail($id);

        if ($expo->status !== 'ended') {
            return response()->json([
                'success' => false,
                'message' => 'Hasil hanya tersedia setelah expo selesai',
            ], 400);
        }

        $ranking = Penilaian::selectRaw('proyek_id, AVG(nilai) as rata_rata, COUNT(*) as jumlah_penilai')
            ->where('expo_id', $id)
            ->groupBy('proyek_id')
            ->orderByDesc('rata_rata')
            ->get()
            ->map(function ($item) {
                $proyek = \App\Models\Proyek::find($item->proyek_id);
                return [
                    'proyek_id'      => $item->proyek_id,
                    'judul'          => $proyek?->judul ?? '-',
                    'rata_rata'      => round($item->rata_rata, 1),
                    'jumlah_penilai' => $item->jumlah_penilai,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'expo'    => [
                    'id'              => $expo->id,
                    'nama'            => $expo->nama,
                    'tanggal_mulai'   => $expo->tanggal_mulai,
                    'tanggal_selesai' => $expo->tanggal_selesai,
                ],
                'ranking' => $ranking,
            ],
        ]);
    }
}