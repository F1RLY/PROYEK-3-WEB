<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProyekController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Profile
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    
    // Proyek
    Route::get('/proyek', [ProyekController::class, 'index']);
    Route::post('/proyek', [ProyekController::class, 'store']);
    Route::get('/proyek/user', [ProyekController::class, 'userProyek']);
    Route::get('/proyek/{id}', [ProyekController::class, 'show']);
    Route::put('/proyek/{id}', [ProyekController::class, 'update']);
    Route::delete('/proyek/{id}', [ProyekController::class, 'destroy']);
    
    // Dosen (untuk dropdown)
    Route::get('/dosen', [ProyekController::class, 'getDosen']);
});