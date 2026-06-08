<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProyekController;
use App\Http\Controllers\API\ExpoController;
use App\Http\Controllers\API\ChatbotController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Expo (public - tidak perlu login)
Route::get('/expo', [ExpoController::class, 'index']);
Route::get('/expo/{id}', [ExpoController::class, 'show']);
Route::get('/expo/{id}/hasil', [ExpoController::class, 'hasil']);
Route::post('/expo/{expoId}/proyek/{proyekId}/nilai', [ExpoController::class, 'nilaiStore']);
Route::post('/chatbot', [ChatbotController::class, 'chat']);

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