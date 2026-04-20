<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\admin;
use App\Http\Controllers\API_DosenController;
use App\Http\Controllers\API_MahasiswaController;
use App\Http\Controllers\API_ProyekController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProyekController;

/*
|--------------------------------------------------------------------------
| 1. GUEST ROUTES (Hanya bisa diakses jika BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| 2. PUBLIC ROUTES (Bisa diakses siapa saja: Guest & Terautentikasi)
|--------------------------------------------------------------------------
*/
Route::get('/', [pageController::class, 'home'])->name('home');
Route::get('/home', [pageController::class, 'home']);
Route::get('/expo', [pageController::class, 'expo'])->name('expo');
Route::get('/about', [pageController::class, 'about'])->name('about');
Route::get('/contact', [pageController::class, 'contact'])->name('contact');

// Repository (List & Detail bisa dilihat publik)
Route::get('/repository', [pageController::class, 'repository'])->name('repository.index');
Route::get('/repository/{code}', [pageController::class, 'repositoryDetail'])->name('repository.detail');

Route::get('/user-profile/{nim}', [pageController::class, 'userProfile']);

// Easter Egg
Route::get('/hehe', function(){
    return "<h1>Selamat :D !!!<br>Anda berhasil menemukan easter egg di website ini</h1>";
});

/*
|--------------------------------------------------------------------------
| 3. AUTH ROUTES (Harus Login - Umum)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']); // Support POST untuk logout
    Route::get('/userProyek', [pageController::class, 'userProyek'])->name('userProyek');
});

/*
|--------------------------------------------------------------------------
| 4. ROLE: MAHASISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/profile', [pageController::class, 'profile'])->name('profile');
    Route::get('/profile/{nim}/edit', [pageController::class, 'profileEdit'])->name('profileEdit');
    Route::post('/profile/update', [pageController::class, 'profileUpdate']);
    Route::post('/profile/update-password', [pageController::class, 'passwordUpdate']);

    // Kelola Proyek (Tambah & Edit)
    Route::get('/profile/{nim}/add-proyek', [pageController::class, 'repositoryAdd']);
    Route::post('/profile/{nim}/add-proyek', [ProyekController::class, 'addNewProyek']);
    Route::get('/repository/{code}/edit', [pageController::class, 'repositoryEdit']);
    Route::post('/repository/{code}/edit', [ProyekController::class, 'updateProyek']);
    Route::delete('/repository/{code}/delete', [proyekController::class, 'deleteProyek']);

    // API Helpers untuk Autocomplete/Search
    Route::get("/mahasiswa-list/{keyword?}", [API_MahasiswaController::class, "getMahasiswaListByKeyword"]);
    Route::get("/dosen-list/{keyword?}", [API_DosenController::class, "getDosenListByKeyword"]);
});

/*
|--------------------------------------------------------------------------
| 5. ROLE: DOSEN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen-profile/{kode}', [pageController::class, 'dosenProfile'])->name('dosen.profile');
});

/*
|--------------------------------------------------------------------------
| 6. ROLE: ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [admin::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin-dashboard', [admin::class, 'admin']);
    
    // Kelola Akun
    Route::get('/admin-kelola-akun', [admin::class, 'kelolaAkun']);
    Route::get('/admin-kelola-akun/{nim}', [admin::class, 'detailAkun']);
    Route::get('/admin-tambah-akun', [admin::class, 'HalamanTambahAkun']);
    
    // Kelola Proyek & Dosen
    Route::get('/admin-kelola-proyek', [admin::class, 'kelolaProyek']);
    Route::get('/admin-detail-proyek/{code}', [admin::class, 'detailProyek']);
    Route::get('/admin-kelola-dosen', [admin::class, 'kelolaDosen']);
    Route::get('/admin-tambah-dosen', [admin::class, 'tambahDosen']);
    Route::post('/admin-tambah-dosen', [DosenController::class, 'tambahDosen']);
    
    // Verifikasi & Penilaian
    Route::get('/admin-vertifikasi', [admin::class, 'vertifikasi']);
    Route::get('/admin-kelolaDanPenilaian', [admin::class, 'kelolaDanPenilaian']);
    
    // API Admin V3
    Route::prefix('api/v3')->group(function() {
        Route::get("/mahasiswa", [API_MahasiswaController::class, "index"]);
        Route::get("/mahasiswa/keyword/{keyword}", [API_MahasiswaController::class, "getByKeyword"]);
        Route::get("/mahasiswa/show/{nim}", [API_MahasiswaController::class, "getByNim"]);
        
        Route::get("/proyek", [API_ProyekController::class, "index"]);
        Route::get("/proyek/keyword/{keyword}", [API_ProyekController::class, "getProyekDataByKeyword"]);
    });
});