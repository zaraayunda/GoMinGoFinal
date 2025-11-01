<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Photo;
use App\Models\TourGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('tanggal_mulai', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('tanggal_mulai', '<=', $request->date_to);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_event', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $events = $query->withCount('photos')->latest()->paginate(12);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:200',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:upcoming,ongoing,done',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo_keterangan.*' => 'nullable|string|max:150',
        ], [
            'nama_event.required' => 'Nama event harus diisi',
            'nama_event.max' => 'Nama event maksimal 150 karakter',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maksimal 200 karakter',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        // Upload foto utama jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('events/foto', $filename, 'public');
        }

        // Buat event
        $event = Event::create([
            'nama_event' => $validated['nama_event'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'lokasi' => $validated['lokasi'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'foto' => $fotoPath,
            'status' => $validated['status'],
        ]);

        // Upload foto tambahan jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('events/photos', $filename, 'public');
                
                Photo::create([
                    'event_id' => $event->id,
                    'file_path' => $path,
                    'keterangan' => $request->input("photo_keterangan.{$index}") ?? null,
                ]);
            }
        }

        return redirect()->route('admin.events.show', $event)
            ->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::with(['photos'])->findOrFail($id);
        
        // Count registrations (akan digunakan setelah migration dibuat)
        $registrationsCount = 0; // Placeholder

        return view('admin.events.show', compact('event', 'registrationsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::with('photos')->findOrFail($id);

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'nama_event' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:200',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:upcoming,ongoing,done',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo_keterangan.*' => 'nullable|string|max:150',
        ]);

        $updateData = [
            'nama_event' => $validated['nama_event'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'lokasi' => $validated['lokasi'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'status' => $validated['status'],
        ];

        // Update foto utama jika ada
        if ($request->hasFile('foto')) {
            if ($event->foto) {
                Storage::disk('public')->delete($event->foto);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('events/foto', $filename, 'public');
            $updateData['foto'] = $fotoPath;
        }

        $event->update($updateData);

        // Upload foto tambahan jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('events/photos', $filename, 'public');
                
                Photo::create([
                    'event_id' => $event->id,
                    'file_path' => $path,
                    'keterangan' => $request->input("photo_keterangan.{$index}") ?? null,
                ]);
            }
        }

        return redirect()->route('admin.events.show', $event)
            ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::with('photos')->findOrFail($id);

        // Hapus foto utama jika ada
        if ($event->foto) {
            Storage::disk('public')->delete($event->foto);
        }

        // Hapus foto-foto tambahan
        foreach ($event->photos as $photo) {
            Storage::disk('public')->delete($photo->file_path);
            $photo->delete();
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Show send invitation form
     */
    public function showSendInvitation($id)
    {
        $event = Event::findOrFail($id);
        $tourGuides = TourGuide::where('status', 'approved')->with('user')->get();

        return view('admin.events.send-invitation', compact('event', 'tourGuides'));
    }

    /**
     * Send invitation to tour guides
     */
    public function sendInvitation(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $request->validate([
            'tour_guide_ids' => 'required|array',
            'tour_guide_ids.*' => 'exists:tour_guides,id',
        ]);

        // Logic untuk kirim undangan akan diimplementasikan nanti
        // Untuk sekarang hanya simpan data
        
        $count = count($request->tour_guide_ids);
        
        return redirect()->route('admin.events.show', $event)
            ->with('success', "Undangan berhasil dikirim ke {$count} tour guide!");
    }

    /**
     * Show participants list
     */
    public function participants($id)
    {
        $event = Event::findOrFail($id);
        
        // Placeholder - akan diimplementasikan setelah migration event_registrations dibuat
        $participants = collect([]);

        return view('admin.events.participants', compact('event', 'participants'));
    }
}

