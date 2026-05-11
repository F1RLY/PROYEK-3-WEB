<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalProyek    = \App\Models\Proyek::count();
        $menunggu       = \App\Models\Proyek::where('verifikasi', 0)->count();
        $totalDosen     = \App\Models\Dosen::count();
        $totalMahasiswa = \App\Models\User::where('role', 'mahasiswa')->count();

        // Proyek menunggu verifikasi (max 5 untuk sidebar)
        $proyekMenunggu = \App\Models\Proyek::where('verifikasi', 0)
            ->latest()
            ->take(5)
            ->get();

        // Proyek terbaru (max 5)
        $proyekTerbaru = \App\Models\Proyek::with('dosen')
            ->latest()
            ->take(5)
            ->get();

        // Proyek per bulan tahun ini (array 12 bulan)
        $proyekPerBulan = collect(range(1, 12))->map(function ($bulan) {
            return \App\Models\Proyek::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $bulan)
                ->count();
        })->toArray();

        return view('admin.dashboard', compact(
            'totalProyek',
            'menunggu',
            'totalDosen',
            'totalMahasiswa',
            'proyekMenunggu',
            'proyekTerbaru',
            'proyekPerBulan'
        ));
    }

    public function expo() 
    {
        return view('admin.expo'); 
    }

    public function proyek(Request $request)
    {
        $query = Proyek::with(['dosen', 'kelompok.anggota.user']);

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter status verifikasi
        if ($request->filled('status')) {
            $query->where('verifikasi', $request->status);
        }

        // Filter tahun (dari created_at)
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $proyeks = $query->latest('created_at')->paginate(10)->withQueryString();

        // Ambil daftar tahun untuk dropdown filter
        $tahuns = Proyek::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.proyek', compact('proyeks', 'tahuns'));
    }

    public function dosen()
    {
        $dosens = \App\Models\Dosen::orderBy('nama')->paginate(10)->withQueryString();
        return view('admin.dosen', compact('dosens'));
    }

    public function dosenStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'NIP'  => 'required|string|max:255',
        ]);

        \App\Models\Dosen::create([
            'nama' => $request->nama,
            'NIP'  => $request->NIP,
        ]);

        return back()->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function dosenUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'NIP'  => 'required|string|max:255',
        ]);

        \App\Models\Dosen::findOrFail($id)->update([
            'nama' => $request->nama,
            'NIP'  => $request->NIP,
        ]);

        return back()->with('success', 'Data dosen berhasil diupdate!');
    }

    public function dosenDestroy($id)
    {
        \App\Models\Dosen::findOrFail($id)->delete();
        return back()->with('success', 'Dosen berhasil dihapus!');
    }

    public function mahasiswa() 
    {
        return view('admin.mahasiswa');
    }

    public function user(Request $request)
    {
        $query = User::with('mahasiswa');

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.user', compact('users'));
    }

    public function userDetail($id)
    {
        $user = User::with('mahasiswa')->findOrFail($id);

        $proyeks = collect();
        if ($user->mahasiswa) {
            $proyekIds = \App\Models\Kelompok::where('mahasiswa', $user->mahasiswa->id)
                ->pluck('proyek');
            $proyeks = Proyek::whereIn('id', $proyekIds)->latest()->get();
        }

        return view('admin.user-detail', compact('user', 'proyeks'));
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