<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * Handle registration from public page - redirect to dashboard for better UX
     * This method exists for backward compatibility with old routes.
     * All event registration should now go through TourGuideEventController.
     */
    public function store(Request $r, Event $event)
    {
        // Redirect ke dashboard event untuk pendaftaran yang lebih user-friendly
        return redirect()->route('tourguide.events.show', $event->id)
            ->with('info', 'Silakan gunakan dashboard Event untuk mendaftar. Alur pendaftaran dari halaman public telah dipindahkan ke dashboard untuk pengalaman yang lebih baik.');
    }
}

