<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourGuideEventController extends Controller
{
    /**
     * Display a listing of events (invitations) for tour guide
     */
    public function index(Request $request)
    {
        $tourGuide = Auth::user()->tourGuide;
        
        if (!$tourGuide) {
            return redirect()->route('tour-guide.dashboard')
                ->with('error', 'Anda belum memiliki profil tour guide.');
        }

        // Ambil semua event yang diundang
        $invitations = EventInvitation::where('tour_guide_id', $tourGuide->id)
            ->with(['event.photos'])
            ->latest('sent_at')
            ->get();

        // Ambil semua pendaftaran yang sudah dilakukan
        $registrations = EventRegistration::where('tour_guide_id', $tourGuide->id)
            ->pluck('event_id')
            ->toArray();

        // Kategorikan event
        $pendingInvitations = $invitations->filter(function ($invitation) use ($registrations) {
            return !in_array($invitation->event_id, $registrations) 
                && $invitation->event->status !== 'done';
        });

        $registeredEvents = EventRegistration::where('tour_guide_id', $tourGuide->id)
            ->with(['event.photos'])
            ->latest()
            ->get();

        // Filter by status
        if ($request->filled('filter')) {
            $filter = $request->filter;
            if ($filter === 'pending') {
                $registeredEvents = $registeredEvents->filter(function ($reg) {
                    return $reg->status === 'pending';
                });
            } elseif ($filter === 'approved') {
                $registeredEvents = $registeredEvents->filter(function ($reg) {
                    return $reg->status === 'approved';
                });
            } elseif ($filter === 'rejected') {
                $registeredEvents = $registeredEvents->filter(function ($reg) {
                    return $reg->status === 'rejected';
                });
            }
        }

        return view('tour-guide.events.index', compact('pendingInvitations', 'registeredEvents', 'tourGuide'));
    }

    /**
     * Show event detail and allow registration
     */
    public function show($id)
    {
        $tourGuide = Auth::user()->tourGuide;
        
        if (!$tourGuide) {
            return redirect()->route('tour-guide.dashboard')
                ->with('error', 'Anda belum memiliki profil tour guide.');
        }

        $event = Event::with('photos')->findOrFail($id);

        // Cek apakah sudah diundang
        $invitation = EventInvitation::where('event_id', $event->id)
            ->where('tour_guide_id', $tourGuide->id)
            ->first();

        // Cek apakah sudah mendaftar
        $registration = EventRegistration::where('event_id', $event->id)
            ->where('tour_guide_id', $tourGuide->id)
            ->first();

        return view('tour-guide.events.show', compact('event', 'invitation', 'registration', 'tourGuide'));
    }

    /**
     * Register for an event
     */
    public function register(Request $request, $id)
    {
        $tourGuide = Auth::user()->tourGuide;
        
        if (!$tourGuide) {
            return back()->with('error', 'Anda belum memiliki profil tour guide.');
        }

        $event = Event::findOrFail($id);

        // Cek apakah sudah mendaftar
        $existingRegistration = EventRegistration::where('event_id', $event->id)
            ->where('tour_guide_id', $tourGuide->id)
            ->first();

        if ($existingRegistration) {
            return back()->with('info', 'Anda sudah mendaftar untuk event ini.');
        }

        // Buat pendaftaran baru
        EventRegistration::create([
            'event_id' => $event->id,
            'tour_guide_id' => $tourGuide->id,
            'status' => 'pending',
            'catatan' => $request->input('catatan'),
        ]);

        return redirect()->route('tourguide.events.index')
            ->with('success', 'Pendaftaran berhasil dikirim! Tunggu persetujuan admin.');
    }
}

