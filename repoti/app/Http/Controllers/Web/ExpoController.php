<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proyek;

class ExpoController extends Controller
{
    public function index()
    {
        $expoProjects = Proyek::with(['gambars', 'kelompok'])
            ->where('verifikasi', 1)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        return view('expo', compact('expoProjects'));
    }
}