<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Kamu wajib membungkus fungsi di dalam class seperti ini
class AdminController extends Controller
{
    public function index() 
    {
        // Ini akan memanggil file: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    }

    public function expo() 
    {
        // Ini akan memanggil file: resources/views/admin/expo.blade.php
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

    public function user() 
    {
        return view('admin.user');
    }

}