<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RepositoryController;
use App\Http\Controllers\Web\ExpoController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProfileController;

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes
Route::get('/profile/{nim}', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{nim}/edit', [ProfileController::class, 'edit']);
Route::post('/profile/{nim}/edit', [ProfileController::class, 'update']);
Route::post('/profile/{nim}/update-password', [ProfileController::class, 'updatePassword']);
Route::get('/profile/{nim}/add-proyek', [ProfileController::class, 'addProyek']);
Route::post('/profile/{nim}/add-proyek', [ProfileController::class, 'storeProyek']);

// Edit & Delete proyek
Route::get('/profile/{nim}/proyek/{id}/edit', [ProfileController::class, 'editProyek']);
Route::post('/profile/{nim}/proyek/{id}/edit', [ProfileController::class, 'updateProyek']);
Route::delete('/profile/{nim}/proyek/{id}/delete', [ProfileController::class, 'deleteProyek']);

// Web routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/repository', [RepositoryController::class, 'index'])->name('repository');
Route::get('/repository/{code}', [RepositoryController::class, 'show'])->name('repository.detail');
Route::get('/expo', [ExpoController::class, 'index'])->name('expo');
Route::get('/about', [AboutController::class, 'index'])->name('about');