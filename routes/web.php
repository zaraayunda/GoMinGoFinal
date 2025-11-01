<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TempatWisataController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TourGuide\EventRegistrationController as TGEventRegController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourGuide\TourGuideReviewController as TGReviewController;
use App\Http\Controllers\TourGuideScheduleController;

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
    Route::get('/login', function () {
        // Redirect berdasarkan role
        if (Auth::user()->role == 'tempat_wisata') {
            return redirect()->route('tempat-wisata.dashboard');
        }
        if (Auth::user()->role == 'tour_guide') {
            return redirect()->route('tour-guide.dashboard');
        }
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
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
    // 🧳 TOUR GUIDE ROUTES
    // ==========================
    Route::get('/tour-guide/dashboard', [\App\Http\Controllers\TourGuideController::class, 'dashboard'])->name('tour-guide.dashboard');
    Route::resource('tour-guide', \App\Http\Controllers\TourGuideController::class);

    // ==========================
    // 👑 ADMIN ROUTES
    // ==========================
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'dashboard'])->name('dashboard');
        
        // Tempat Wisata Routes
        Route::prefix('tempat-wisata')->name('tempat-wisata.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'reject'])->name('reject');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'destroy'])->name('destroy');
            Route::delete('/photo/{id}', [\App\Http\Controllers\Admin\AdminTempatWisataController::class, 'deletePhoto'])->name('photo.delete');
        });
        
        // Tour Guide Routes
        Route::prefix('tour-guide')->name('tour-guide.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'reject'])->name('reject');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'destroy'])->name('destroy');
        });
        
        // Users Routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/reset-password', [\App\Http\Controllers\Admin\AdminUserController::class, 'resetPassword'])->name('reset-password');
        });
        
        // Events Routes
        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminEventController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\AdminEventController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\AdminEventController::class, 'store'])->name('store');
            Route::get('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\AdminEventController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/send-invitation', [\App\Http\Controllers\Admin\AdminEventController::class, 'showSendInvitation'])->name('send-invitation');
            Route::post('/{id}/send-invitation', [\App\Http\Controllers\Admin\AdminEventController::class, 'sendInvitation'])->name('send-invitation.store');
            Route::get('/{id}/participants', [\App\Http\Controllers\Admin\AdminEventController::class, 'participants'])->name('participants');
        });
    Route::get('/tour-guide/dashboard', [TourGuideController::class, 'dashboard'])->name('tour-guide.dashboard');
    Route::resource('tour-guide', TourGuideController::class);

    // Tour Guide Schedule Routes
    Route::prefix('guide/schedules')->middleware('role:tour_guide')->group(function() {
        Route::get('/', [TourGuideScheduleController::class, 'index'])->name('guide.schedules.index');
        Route::post('/', [TourGuideScheduleController::class, 'store'])->name('guide.schedules.store');
        Route::put('/{schedule}', [TourGuideScheduleController::class, 'update'])->name('guide.schedules.update');
        Route::delete('/{schedule}', [TourGuideScheduleController::class, 'destroy'])->name('guide.schedules.destroy');
    });
});

// ==========================
// 🌍 USER-FACING PAGES (PUBLIC)
// ==========================
Route::get('/peta', [TempatWisataController::class, 'showMap']);
Route::get('/detailwisata', function () {
    return view('user.detailwisata');
});
// Public detail page for a tempat wisata (can be accessed from map popups)
Route::get('/detailwisata/{id}', [TempatWisataController::class, 'publicShow'])->name('detailwisata.show');
Route::get('/tourguide', [TourGuideController::class, 'publicIndex'])
    ->name('tourguide.index');
Route::get('/event', function () {
    return view('user.event');
});
// Public Tour Guide detail (user-facing)
Route::get('/tourguide/{id}', [TourGuideController::class, 'publicShow'])
    ->name('tourguide.public');
Route::get('/tourguide', [TourGuideController::class, 'publicIndex'])->name('tourguide.index');
Route::get('/tourguide/{id}', [TourGuideController::class, 'publicShow'])->name('tourguide.public');
Route::get('/event', [EventController::class, 'publicIndex'])->name('events.list');
Route::get('/event/{event}', [EventController::class, 'publicShow'])->name('events.show');// ✅ <— tambahkan ini untuk menutup route event!

 
// ==========================
// 🤖 AI CHAT ROUTES (PUBLIC)
// ==========================
Route::get('/ai', function () {
    return view('ai-ask');
})->name('ai.ask');

Route::post('/ask-ai', [GeminiController::class, 'askAI'])->name('ai.chat');
    // Tour Guide Routes
    Route::prefix('tour-guide')->name('tour-guide.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminTourGuideController::class, 'destroy'])->name('destroy');
    });

    // Users Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/reset-password', [\App\Http\Controllers\Admin\AdminUserController::class, 'resetPassword'])->name('reset-password');
    });

    // Events Routes
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminEventController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\AdminEventController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\AdminEventController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\AdminEventController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\AdminEventController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/send-invitation', [\App\Http\Controllers\Admin\AdminEventController::class, 'showSendInvitation'])->name('send-invitation');
        Route::post('/{id}/send-invitation', [\App\Http\Controllers\Admin\AdminEventController::class, 'sendInvitation'])->name('send-invitation.store');
        Route::get('/{id}/participants', [\App\Http\Controllers\Admin\AdminEventController::class, 'participants'])->name('participants');
    });
});

Route::permanentRedirect('/detailevent', '/event');

Route::middleware(['auth','role:tour_guide'])->group(function () {
    Route::post(
        '/tour-guide/events/{event}/register',
        [TGEventRegController::class, 'store']
    )->name('tourguide.events.register');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
  Route::prefix('events')->name('events.')->group(function () {
    // ... route events lain (index/show/participants)

    Route::post('/{event}/participants/{registration}/approve',
      [\App\Http\Controllers\Admin\AdminEventController::class, 'approveParticipant']
    )->name('participants.approve');

    Route::post('/{event}/participants/{registration}/reject',
      [\App\Http\Controllers\Admin\AdminEventController::class, 'rejectParticipant']
    )->name('participants.reject');
  });
});

// routes/web.php
Route::post('/tempat-wisata/{tempat}/reviews',
    [\App\Http\Controllers\ReviewController::class, 'store']
)->name('wisata.reviews.store');



Route::post('/tourguide/{tourGuide}/reviews', [TGReviewController::class,'store'])
    ->name('tourguide.reviews.store');



// publik (JSON untuk kalender)
Route::get('/tourguide/{tourGuide}/schedules.json',
    [TourGuideScheduleController::class,'publicList']
)->name('tourguide.schedules.json');

// khusus role tour_guide: CRUD jadwal
Route::middleware(['auth','role:tour_guide'])->group(function () {
    Route::get('/tour-guide/schedules',           [TourGuideScheduleController::class,'index'])->name('guide.schedules.index');
    Route::post('/tour-guide/schedules',          [TourGuideScheduleController::class,'store'])->name('guide.schedules.store');
    Route::put('/tour-guide/schedules/{schedule}',[TourGuideScheduleController::class,'update'])->name('guide.schedules.update');
    Route::delete('/tour-guide/schedules/{schedule}',[TourGuideScheduleController::class,'destroy'])->name('guide.schedules.destroy');
});

// sementara, di web.php
Route::middleware(['auth'])->group(function () {
  Route::get('/tour-guide/schedules',[TourGuideScheduleController::class,'index'])->name('guide.schedules.index');
  // ...
});

