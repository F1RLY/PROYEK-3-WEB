<?php

use App\Http\Controllers\pageController;
use App\Http\Controllers\admin;
use App\Http\Controllers\API_MahasiswaController;
use App\Http\Controllers\API_ProyekController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;


Route::get("/mahasiswa", [API_MahasiswaController::class, "index"])->name("getMahasiswaData");
Route::get("/mahasiswa/{index}", [API_MahasiswaController::class, "getByNim"])->name("getByNim");
Route::get("/mahasiswa/keyword/{keyword}", [API_MahasiswaController::class, "getByKeyword"])->name("getMahasiswaData");
Route::get("/mahasiswa/show/{nim}", [API_MahasiswaController::class, "getByNim"])->name("getMahasiswaData");
