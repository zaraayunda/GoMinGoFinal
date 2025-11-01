<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use App\Models\TourGuideSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourGuideScheduleController extends Controller
{
    // Halaman manajemen (sederhana: list + form tambah)
    public function index()
{
    $guide = TourGuide::where('user_id', Auth::id())->first();

    if (!$guide) {
        return redirect()
            ->route('tour-guide.index')
            ->with('error', 'Buat profil tour guide dulu sebelum kelola jadwal.');
    }

    $schedules = $guide->schedules()->orderBy('start_at','asc')->get();
    return view('tour-guide.schedules', compact('guide','schedules'));
}


    public function store(Request $r)
    {
        $guide = TourGuide::where('user_id', Auth::id())->firstOrFail();

        $data = $r->validate([
            'start_at' => 'required|date',
            'end_at'   => 'required|date|after:start_at',
            'status'   => 'required|in:available,booked,blocked',
            'title'    => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'note'     => 'nullable|string',
        ]);

        // Cek overlap pada guide yg sama
        $overlap = TourGuideSchedule::where('tour_guide_id',$guide->id)
            ->where(function($q) use ($data){
                $q->where('start_at','<',$data['end_at'])
                  ->where('end_at','>',$data['start_at']);
            })->exists();

        if ($overlap) {
            return back()->with('error','Rentang waktu bertabrakan dengan jadwal lain.');
        }

        $data['tour_guide_id'] = $guide->id;
        TourGuideSchedule::create($data);

        return back()->with('success','Jadwal berhasil ditambahkan.');
    }

    public function update(Request $r, TourGuideSchedule $schedule)
    {
        // authorize pemilik
        $guide = TourGuide::where('user_id', Auth::id())->firstOrFail();
        abort_unless($schedule->tour_guide_id === $guide->id, 403);

        $data = $r->validate([
            'start_at' => 'required|date',
            'end_at'   => 'required|date|after:start_at',
            'status'   => 'required|in:available,booked,blocked',
            'title'    => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'note'     => 'nullable|string',
        ]);

        $overlap = TourGuideSchedule::where('tour_guide_id',$guide->id)
            ->where('id','!=',$schedule->id)
            ->where(function($q) use ($data){
                $q->where('start_at','<',$data['end_at'])
                  ->where('end_at','>',$data['start_at']);
            })->exists();

        if ($overlap) {
            return back()->with('error','Rentang waktu bertabrakan dengan jadwal lain.');
        }

        $schedule->update($data);
        return back()->with('success','Jadwal diperbarui.');
    }

    public function destroy(TourGuideSchedule $schedule)
    {
        $guide = TourGuide::where('user_id', Auth::id())->firstOrFail();
        abort_unless($schedule->tour_guide_id === $guide->id, 403);

        $schedule->delete();
        return back()->with('success','Jadwal dihapus.');
    }

    // === API publik utk kalender di detail TG ===
    public function publicList(Request $r, TourGuide $tourGuide)
    {
        // filter rentang (opsional)
        $start = $r->query('start'); // ISO date
        $end   = $r->query('end');

        $query = $tourGuide->schedules()->select(['id','start_at','end_at','status','title','location','note']);

        if ($start && $end) {
            $query->where('start_at','<',$end)->where('end_at','>',$start);
        } else {
            // default 60 hari ke depan
            $query->where('end_at','>=', now())->where('start_at','<=', now()->addDays(60));
        }

        // Format untuk FullCalendar
        $events = $query->get()->map(function($s){
            return [
                'id'    => $s->id,
                'title' => $s->title ?: strtoupper($s->status), // caption
                'start' => $s->start_at->toIso8601String(),
                'end'   => $s->end_at->toIso8601String(),
                'extendedProps' => [
                    'status'   => $s->status,
                    'location' => $s->location,
                    'note'     => $s->note,
                ],
                // warna sederhana per status
                'color' => match($s->status){
                    'booked'   => '#dc3545',
                    'blocked'  => '#6c757d',
                    default    => '#198754',
                }
            ];
        });

        return response()->json($events);
    }
}
