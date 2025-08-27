<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiBobotController;
use App\Http\Controllers\PengunjungController;

Route::get('/', [PengunjungController::class, 'home']);
Route::get('/profil', [PengunjungController::class, 'profil']);
Route::get('/deskripsi', [PengunjungController::class, 'deskripsi']);
// Route::get('/filter', [PengunjungController::class, 'filter']);
Route::get('/rekomendasi', [PengunjungController::class, 'rekomendasi']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/dashboard', function () {
    return view('Dashboard.dashboard');
})->middleware('auth');

Route::resource('/dashboard/alternatif', AlternatifController::class)->middleware('auth');
Route::resource('/dashboard/kriteria', KriteriaController::class)->middleware('auth');
Route::resource('/dashboard/sub-bobot', NilaiBobotController::class)->middleware('auth');
Route::resource('/dashboard/matriks', HasilController::class)->middleware('auth');
Route::get('/dashboard/hasil', [SpkController::class, 'index'])->name('Dashboard.hasil')->middleware('auth');

Route::resource('/dashboard/deskripsi', DeskripsiController::class)->middleware('auth');
Route::resource('/dashboard/profil', ProfilController::class)->middleware('auth');

Route::get('/filter', [FilterController::class, 'index']);
Route::post('/filter-wisata', [FilterController::class, 'filter']);
