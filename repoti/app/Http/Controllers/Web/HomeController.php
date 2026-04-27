<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proyek;

class HomeController extends Controller
{
    public function index()
    {
        $allProjects = Proyek::with(['gambars', 'kelompok'])->orderBy('created_at', 'desc')->get();
        $topProjects = Proyek::with(['gambars', 'kelompok'])->where('verifikasi', 1)->orderBy('created_at', 'desc')->take(3)->get();
        
        return view('home', compact('allProjects', 'topProjects'));
    }
}