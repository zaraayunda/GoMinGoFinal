<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'showRegisterForm'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Redirect berdasarkan role
        if (Auth::user()->role == 'tempat_wisata') {
            return redirect()->route('tempat-wisata.dashboard');
        }
        if (Auth::user()->role == 'tour_guide') {
            return redirect()->route('tour-guide.dashboard');
        }
        return view('layout.dashboard');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Tempat Wisata Routes
    Route::get('/tempat-wisata/dashboard', [\App\Http\Controllers\TempatWisataController::class, 'dashboard'])->name('tempat-wisata.dashboard');
    Route::resource('tempat-wisata', \App\Http\Controllers\TempatWisataController::class);
    Route::delete('tempat-wisata/photo/{photo}', [\App\Http\Controllers\TempatWisataController::class, 'deletePhoto'])
        ->name('tempat-wisata.photo.delete');

    // Tour Guide Routes
    Route::get('/tour-guide/dashboard', [\App\Http\Controllers\TourGuideController::class, 'dashboard'])->name('tour-guide.dashboard');
    Route::resource('tour-guide', \App\Http\Controllers\TourGuideController::class);
});
