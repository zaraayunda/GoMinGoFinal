<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourGuide;
use App\Models\DetailTourGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminTourGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TourGuide::with(['user', 'detailTourGuides']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by spesialisasi
        if ($request->filled('spesialisasi')) {
            $query->where('spesialisasi', $request->spesialisasi);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $tourGuides = $query->latest()->paginate(12);

        return view('admin.tour-guide.index', compact('tourGuides'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tourGuide = TourGuide::with(['user', 'detailTourGuides'])->findOrFail($id);

        return view('admin.tour-guide.show', compact('tourGuide'));
    }

    /**
     * Approve tour guide
     */
    public function approve($id)
    {
        $tourGuide = TourGuide::findOrFail($id);
        $tourGuide->update(['status' => 'approved']);

        return redirect()->route('admin.tour-guide.index')
            ->with('success', 'Tour guide berhasil disetujui!');
    }

    /**
     * Reject tour guide
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $tourGuide = TourGuide::findOrFail($id);
        $tourGuide->update(['status' => 'rejected']);

        return redirect()->route('admin.tour-guide.index')
            ->with('success', 'Tour guide ditolak. ' . ($request->reason ? 'Alasan: ' . $request->reason : ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tourGuide = TourGuide::with('detailTourGuides')->findOrFail($id);

        // Hapus foto jika ada
        if ($tourGuide->foto) {
            Storage::disk('public')->delete($tourGuide->foto);
        }

        // Hapus semua sertifikat dari detail
        foreach ($tourGuide->detailTourGuides as $detail) {
            if ($detail->sertifikat) {
                Storage::disk('public')->delete($detail->sertifikat);
            }
        }

        $tourGuide->delete();

        return redirect()->route('admin.tour-guide.index')
            ->with('success', 'Tour guide berhasil dihapus!');
    }
}

