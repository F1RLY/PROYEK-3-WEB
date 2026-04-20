<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil data user yang sedang login
        Route::get('/profile', [pageController::class, 'profile'] )->name('profile');
    }
}
