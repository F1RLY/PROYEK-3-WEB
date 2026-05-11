<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyek;

class AdminController extends Controller
{
    public function index() 
    {
        return view('admin.dashboard');
    }

    public function expo() 
    {
        return view('admin.expo'); 
    }

    public function proyek() 
    {
        return view('admin.proyek');
    }

    public function dosen() 
    {
        return view('admin.dosen');
    }

    public function mahasiswa() 
    {
        return view('admin.mahasiswa');
    }

    public function user() 
    {
        return view('admin.user');
    }

    public function verifikasi()
    {
        $proyeks = Proyek::with(['dosen'])
            ->where('verifikasi', 0)
            ->latest('created_at')
            ->get();

        return view('admin.verifikasi', compact('proyeks'));
    }

    public function setujui($id)
    {
        Proyek::findOrFail($id)->update(['verifikasi' => 1]);
        return back()->with('success', 'Proyek berhasil disetujui!');
    }

    public function tolak($id)
    {
        Proyek::findOrFail($id)->update(['verifikasi' => 2]);
        return back()->with('success', 'Proyek ditolak.');
    }

    public function detailVerifikasi($id)
    {
        $proyek = Proyek::with(['dosen', 'gambars', 'kelompok.anggota.user'])
            ->findOrFail($id);

        return view('admin.verifikasi-detail', compact('proyek'));
    }
}