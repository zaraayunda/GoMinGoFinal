<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\EventRegistration;

class EventController extends Controller
{

    
    public function publicIndex()
    {
        $events = Event::query()
            ->latest()
            ->paginate(9);

        return view('user.event', compact('events'));
    }

    public function publicShow(Event $event)
    {
        // Ambil hanya pendaftar berstatus approved
        $participants = EventRegistration::with(['tourGuide.user'])
            ->where('event_id', $event->id)
            ->where('status', 'approved')   // atau ->approved() kalo pake scope
            ->latest()
            ->get();

        return view('user.detailevent', compact('event','participants'));
    }
    public function index()
    {
        $events = Event::query()
            ->when(Auth::user()->role === 'tempat_wisata', function ($q) {
                return $q->where('tempat_wisata_id', Auth::user()->tempatWisata->id);
            })
            ->latest()
            ->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'foto' => 'nullable|image|max:5120'
        ]);

        $event = new Event($request->all());
        $event->tempat_wisata_id = Auth::user()->tempatWisata->id;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('events', 'public');
            $event->foto = $path;
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function edit(Event $event)
    {
        if ($event->tempat_wisata_id !== Auth::user()->tempatWisata->id) {
            return redirect()->route('events.index')->with('error', 'Anda tidak memiliki akses ke event ini');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->tempat_wisata_id !== Auth::user()->tempatWisata->id) {
            return redirect()->route('events.index')->with('error', 'Anda tidak memiliki akses ke event ini');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'foto' => 'nullable|image|max:5120'
        ]);

        $event->fill($request->except('foto'));

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('events', 'public');
            $event->foto = $path;
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui');
    }

    public function destroy(Event $event)
    {
        if ($event->tempat_wisata_id !== Auth::user()->tempatWisata->id) {
            return redirect()->route('events.index')->with('error', 'Anda tidak memiliki akses ke event ini');
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
    }
}
