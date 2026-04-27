<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Proyek::with(['gambars', 'kelompok']);
        
        if ($request->has('q') && $request->q) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }
        
        $proyek = $query->orderBy('created_at', 'desc')->paginate(12);
        
        return view('repository', compact('proyek'));
    }
    
    public function show($code)
    {
        $proyek = Proyek::with(['gambars', 'kelompok.mahasiswa.user', 'dosen'])
            ->where('repoCode', $code)
            ->firstOrFail();
        
        return view('repository-detail', compact('proyek'));
    }
}