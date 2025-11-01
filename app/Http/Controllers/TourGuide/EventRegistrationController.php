<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function store(Request $r, Event $event)
    {
        $tg = Auth::user()->tourGuide; // pastikan relasi ada di User model
        if (!$tg) return back()->with('error','Akun ini bukan Tour Guide.');

        EventRegistration::firstOrCreate(
            ['event_id'=>$event->id,'tour_guide_id'=>$tg->id],
            ['status'=>'pending','catatan'=>$r->input('catatan')]
        );

        return back()->with('success','Pendaftaran dikirim. Tunggu persetujuan admin.');
    }

    // app/Http/Controllers/EventController.php
public function publicShow(\App\Models\Event $event)
{
    // Ambil pendaftar yang approved + data user TG
    $participants = \App\Models\EventRegistration::with(['tourGuide.user'])
        ->where('event_id', $event->id)
        ->where('status', 'approved') // kalau mau tampilkan semua, hapus baris ini
        ->latest()
        ->get();

    return view('user.detailevent', compact('event', 'participants'));
}

}

