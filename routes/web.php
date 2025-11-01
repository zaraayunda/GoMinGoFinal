<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TempatWisataController;
use App\Http\Controllers\TourGuideController;

Route::get('/', function () {
    return view('welcome');
});

// ==========================
// 🔐 AUTHENTICATION ROUTES
// ==========================
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

    // ==========================
    // 🏞️ TEMPAT WISATA ROUTES
    // ==========================
    Route::get('/tempat-wisata/dashboard', [TempatWisataController::class, 'dashboard'])->name('tempat-wisata.dashboard');
    Route::resource('tempat-wisata', TempatWisataController::class);
    Route::delete('tempat-wisata/photo/{photo}', [TempatWisataController::class, 'deletePhoto'])
        ->name('tempat-wisata.photo.delete');

    // ==========================
    // 🧭 TOUR GUIDE ROUTES
    // ==========================
    Route::get('/tour-guide/dashboard', [TourGuideController::class, 'dashboard'])->name('tour-guide.dashboard');
    Route::resource('tour-guide', TourGuideController::class);
});

// ==========================
// 🌍 USER-FACING PAGES
// ==========================
Route::get('/peta', function () {
    return view('user.peta');
});
Route::get('/detailwisata', function () {
    return view('user.detailwisata');
});
Route::get('/tourguide', function () {
    return view('user.tourguide');
});
Route::get('/event', function () {
    return view('user.event');
});
