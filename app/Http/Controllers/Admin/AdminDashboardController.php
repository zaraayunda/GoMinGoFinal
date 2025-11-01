<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempatWisata;
use App\Models\TourGuide;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        // Statistik Tempat Wisata
        $tempatWisataStats = TempatWisata::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalTempatWisata = TempatWisata::count();
        $pendingTempatWisata = $tempatWisataStats['pending'] ?? 0;
        $approvedTempatWisata = $tempatWisataStats['approved'] ?? 0;
        $rejectedTempatWisata = $tempatWisataStats['rejected'] ?? 0;

        // Statistik Tour Guide
        $tourGuideStats = TourGuide::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalTourGuide = TourGuide::count();
        $pendingTourGuide = $tourGuideStats['pending'] ?? 0;
        $approvedTourGuide = $tourGuideStats['approved'] ?? 0;
        $rejectedTourGuide = $tourGuideStats['rejected'] ?? 0;

        // Statistik Users
        $userStats = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        $totalUsers = User::count();
        $totalAdmin = $userStats['admin'] ?? 0;
        $totalTourGuideUsers = $userStats['tour_guide'] ?? 0;
        $totalTempatWisataUsers = $userStats['tempat_wisata'] ?? 0;

        // Statistik Events
        $eventStats = Event::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalEvents = Event::count();
        $upcomingEvents = $eventStats['upcoming'] ?? 0;
        $ongoingEvents = $eventStats['ongoing'] ?? 0;
        $doneEvents = $eventStats['done'] ?? 0;

        // Recent Activities
        $recentTempatWisata = TempatWisata::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentTourGuide = TourGuide::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTempatWisata',
            'pendingTempatWisata',
            'approvedTempatWisata',
            'rejectedTempatWisata',
            'totalTourGuide',
            'pendingTourGuide',
            'approvedTourGuide',
            'rejectedTourGuide',
            'totalUsers',
            'totalAdmin',
            'totalTourGuideUsers',
            'totalTempatWisataUsers',
            'totalEvents',
            'upcomingEvents',
            'ongoingEvents',
            'doneEvents',
            'recentTempatWisata',
            'recentTourGuide'
        ));
    }
}

