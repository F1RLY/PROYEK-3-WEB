<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RepositoryController;
use App\Http\Controllers\Web\ExpoController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\AdminController;

// --- AUTH ROUTES ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PROFILE ROUTES ---
Route::get('/profile/{nim}', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{nim}/edit', [ProfileController::class, 'edit']);
Route::post('/profile/{nim}/edit', [ProfileController::class, 'update']);
Route::post('/profile/{nim}/update-password', [ProfileController::class, 'updatePassword']);
Route::get('/profile/{nim}/add-proyek', [ProfileController::class, 'addProyek']);
Route::post('/profile/{nim}/add-proyek', [ProfileController::class, 'storeProyek']);
Route::get('/profile/{nim}/proyek/{id}/edit', [ProfileController::class, 'editProyek']);
Route::post('/profile/{nim}/proyek/{id}/edit', [ProfileController::class, 'updateProyek']);
Route::delete('/profile/{nim}/proyek/{id}/delete', [ProfileController::class, 'deleteProyek']);

// --- USER WEB ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/repository', [RepositoryController::class, 'index'])->name('repository');
Route::get('/repository/{code}', [RepositoryController::class, 'show'])->name('repository.detail');
Route::get('/expo', [ExpoController::class, 'index'])->name('expo'); // Ini untuk user biasa
Route::get('/about', [AboutController::class, 'index'])->name('about');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/expo', [AdminController::class, 'expo'])->name('admin.expo');
    Route::get('/proyek', [AdminController::class, 'proyek'])->name('admin.proyek');
    Route::get('/dosen', [AdminController::class, 'dosen'])->name('admin.dosen');
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
});