<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempatWisata;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminTempatWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TempatWisata::with(['user', 'photos']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_tempat', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $tempatWisatas = $query->latest()->paginate(12);

        return view('admin.tempat-wisata.index', compact('tempatWisatas'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tempatWisata = TempatWisata::with(['user', 'photos', 'reviews', 'favorites'])
            ->findOrFail($id);

        return view('admin.tempat-wisata.show', compact('tempatWisata'));
    }

    /**
     * Approve tempat wisata
     */
    public function approve($id)
    {
        $tempatWisata = TempatWisata::findOrFail($id);
        $tempatWisata->update(['status' => 'approved']);

        return redirect()->route('admin.tempat-wisata.index')
            ->with('success', 'Tempat wisata berhasil disetujui!');
    }

    /**
     * Reject tempat wisata
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $tempatWisata = TempatWisata::findOrFail($id);
        $tempatWisata->update(['status' => 'rejected']);

        return redirect()->route('admin.tempat-wisata.index')
            ->with('success', 'Tempat wisata ditolak. ' . ($request->reason ? 'Alasan: ' . $request->reason : ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tempatWisata = TempatWisata::with('photos')->findOrFail($id);

        // Hapus foto-foto terkait
        foreach ($tempatWisata->photos as $photo) {
            Storage::disk('public')->delete($photo->file_path);
            $photo->delete();
        }

        // Hapus bukti kepemilikan
        if ($tempatWisata->bukti_kepemilikan) {
            Storage::disk('public')->delete($tempatWisata->bukti_kepemilikan);
        }

        $tempatWisata->delete();

        return redirect()->route('admin.tempat-wisata.index')
            ->with('success', 'Tempat wisata berhasil dihapus!');
    }

    /**
     * Delete a photo
     */
    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);

        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}

