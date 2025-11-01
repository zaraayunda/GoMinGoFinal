<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\TourGuide;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TempatWisataController extends Controller
{
    /**
     * Display dashboard
     */
    public function dashboard()
    {
        return view('tempat-wisata.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tempatWisatas = TempatWisata::where('user_id', Auth::id())
            ->with('photos')
            ->latest()
            ->get();

        // Cek apakah user sudah punya tempat wisata yang approved atau pending
        $canCreate = !TempatWisata::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->exists();

        return view('tempat-wisata.index', compact('tempatWisatas', 'canCreate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek apakah user sudah punya tempat wisata yang approved atau pending
        $existingTempatWisata = TempatWisata::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        if ($existingTempatWisata) {
            $statusText = $existingTempatWisata->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
            return redirect()->route('tempat-wisata.index')
                ->with('error', "Anda sudah memiliki tempat wisata yang {$statusText}. Anda tidak dapat mendaftarkan tempat wisata baru hingga status tempat wisata saat ini berubah.");
        }

        return view('tempat-wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah punya tempat wisata yang approved atau pending
        $existingTempatWisata = TempatWisata::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        if ($existingTempatWisata) {
            $statusText = $existingTempatWisata->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
            return redirect()->route('tempat-wisata.index')
                ->with('error', "Anda sudah memiliki tempat wisata yang {$statusText}. Anda tidak dapat mendaftarkan tempat wisata baru hingga status tempat wisata saat ini berubah.");
        }

        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:150',
            'kategori' => 'required|in:alam,kuliner,budaya',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'tiket_masuk' => 'nullable|numeric|min:0',
            'kontak' => 'nullable|string|max:50',
            'jam_buka' => 'nullable|string|max:50',
            'bukti_kepemilikan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
            'tipe_bukti' => 'required|in:sertifikat,surat_izin,akta,lainnya',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
            'photo_keterangan.*' => 'nullable|string|max:150',
        ], [
            'nama_tempat.required' => 'Nama tempat harus diisi',
            'nama_tempat.max' => 'Nama tempat maksimal 150 karakter',
            'kategori.required' => 'Kategori harus dipilih',
            'kategori.in' => 'Kategori tidak valid',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'latitude.between' => 'Latitude harus antara -90 sampai 90',
            'longitude.numeric' => 'Longitude harus berupa angka',
            'longitude.between' => 'Longitude harus antara -180 sampai 180',
            'tiket_masuk.numeric' => 'Tiket masuk harus berupa angka',
            'tiket_masuk.min' => 'Tiket masuk tidak boleh negatif',
            'kontak.max' => 'Kontak maksimal 50 karakter',
            'jam_buka.max' => 'Jam buka maksimal 50 karakter',
            'bukti_kepemilikan.required' => 'Bukti kepemilikan harus diupload',
            'bukti_kepemilikan.file' => 'Bukti kepemilikan harus berupa file',
            'bukti_kepemilikan.mimes' => 'Format bukti kepemilikan harus PDF, JPG, JPEG, atau PNG',
            'bukti_kepemilikan.max' => 'Ukuran file bukti kepemilikan maksimal 10MB',
            'tipe_bukti.required' => 'Tipe bukti harus dipilih',
            'tipe_bukti.in' => 'Tipe bukti tidak valid',
            'photos.array' => 'Foto harus berupa array',
            'photos.*.image' => 'File harus berupa gambar',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'photos.*.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Upload bukti kepemilikan
        $buktiKepemilikanPath = null;
        if ($request->hasFile('bukti_kepemilikan')) {
            $file = $request->file('bukti_kepemilikan');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $buktiKepemilikanPath = $file->storeAs('tempat-wisata/bukti-kepemilikan', $filename, 'public');
        }

        // Buat tempat wisata
        $tempatWisata = TempatWisata::create([
            'user_id' => Auth::id(),
            'nama_tempat' => $validated['nama_tempat'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'alamat' => $validated['alamat'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'tiket_masuk' => $validated['tiket_masuk'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'jam_buka' => $validated['jam_buka'] ?? null,
            'bukti_kepemilikan' => $buktiKepemilikanPath,
            'tipe_bukti' => $validated['tipe_bukti'],
            'status' => 'pending',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('tempat-wisata/photos', $filename, 'public');

                Photo::create([
                    'tempat_wisata_id' => $tempatWisata->id,
                    'file_path' => $path,
                    'keterangan' => $request->input("photo_keterangan.{$index}") ?? null,
                ]);
            }
        }

        return redirect()->route('tempat-wisata.index')
            ->with('success', 'Tempat wisata berhasil ditambahkan! Menunggu persetujuan admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tempatWisata = TempatWisata::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('photos', 'reviews', 'user')
            ->firstOrFail();

        return view('tempat-wisata.show', compact('tempatWisata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tempatWisata = TempatWisata::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('photos')
            ->firstOrFail();

        return view('tempat-wisata.edit', compact('tempatWisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tempatWisata = TempatWisata::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:150',
            'kategori' => 'required|in:alam,kuliner,budaya',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'tiket_masuk' => 'nullable|numeric|min:0',
            'kontak' => 'nullable|string|max:50',
            'jam_buka' => 'nullable|string|max:50',
            'bukti_kepemilikan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
            'tipe_bukti' => 'nullable|in:sertifikat,surat_izin,akta,lainnya',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo_keterangan.*' => 'nullable|string|max:150',
        ], [
            'nama_tempat.required' => 'Nama tempat harus diisi',
            'nama_tempat.max' => 'Nama tempat maksimal 150 karakter',
            'kategori.required' => 'Kategori harus dipilih',
            'kategori.in' => 'Kategori tidak valid',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'latitude.between' => 'Latitude harus antara -90 sampai 90',
            'longitude.numeric' => 'Longitude harus berupa angka',
            'longitude.between' => 'Longitude harus antara -180 sampai 180',
            'tiket_masuk.numeric' => 'Tiket masuk harus berupa angka',
            'tiket_masuk.min' => 'Tiket masuk tidak boleh negatif',
            'kontak.max' => 'Kontak maksimal 50 karakter',
            'jam_buka.max' => 'Jam buka maksimal 50 karakter',
            'bukti_kepemilikan.file' => 'Bukti kepemilikan harus berupa file',
            'bukti_kepemilikan.mimes' => 'Format bukti kepemilikan harus PDF, JPG, JPEG, atau PNG',
            'bukti_kepemilikan.max' => 'Ukuran file bukti kepemilikan maksimal 10MB',
            'tipe_bukti.in' => 'Tipe bukti tidak valid',
            'photos.array' => 'Foto harus berupa array',
            'photos.*.image' => 'File harus berupa gambar',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'photos.*.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Handle bukti kepemilikan (update jika ada file baru, atau keep yang lama)
        $updateData = [
            'nama_tempat' => $validated['nama_tempat'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'alamat' => $validated['alamat'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'tiket_masuk' => $validated['tiket_masuk'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'jam_buka' => $validated['jam_buka'] ?? null,
        ];

        // Upload bukti kepemilikan baru jika ada
        if ($request->hasFile('bukti_kepemilikan')) {
            // Hapus file lama jika ada
            if ($tempatWisata->bukti_kepemilikan) {
                Storage::disk('public')->delete($tempatWisata->bukti_kepemilikan);
            }

            $file = $request->file('bukti_kepemilikan');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $buktiKepemilikanPath = $file->storeAs('tempat-wisata/bukti-kepemilikan', $filename, 'public');
            $updateData['bukti_kepemilikan'] = $buktiKepemilikanPath;
        }

        // Update tipe bukti jika ada
        if ($request->filled('tipe_bukti')) {
            $updateData['tipe_bukti'] = $validated['tipe_bukti'];
        }

        // Update tempat wisata
        $tempatWisata->update($updateData);

        // Upload foto baru jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('tempat-wisata/photos', $filename, 'public');

                Photo::create([
                    'tempat_wisata_id' => $tempatWisata->id,
                    'file_path' => $path,
                    'keterangan' => $request->input("photo_keterangan.{$index}") ?? null,
                ]);
            }
        }

        return redirect()->route('tempat-wisata.index')
            ->with('success', 'Tempat wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tempatWisata = TempatWisata::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hapus foto-foto terkait
        foreach ($tempatWisata->photos as $photo) {
            Storage::disk('public')->delete($photo->file_path);
            $photo->delete();
        }

        $tempatWisata->delete();

        return redirect()->route('tempat-wisata.index')
            ->with('success', 'Tempat wisata berhasil dihapus!');
    }

    /**
     * Delete a photo
     */
    public function deletePhoto($id)
    {
        $photo = Photo::whereHas('tempatWisata', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('id', $id)->firstOrFail();

        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    /**
     * Display map with all tourist spots
     */

    public function showMap(Request $r)
    {
        $kat = strtolower((string) $r->query('kategori', ''));
        $qstr = trim((string) $r->query('q', ''));
        $allowed = ['alam', 'kuliner', 'budaya'];

        $q = TempatWisata::with('photos');

        if (in_array($kat, $allowed, true)) {
            $q->where('kategori', $kat);
        }

        if ($qstr !== '') {
            $q->where(function ($w) use ($qstr) {
                $w->where('nama_tempat', 'like', "%{$qstr}%")
                    ->orWhere('alamat', 'like', "%{$qstr}%")
                    ->orWhere('deskripsi', 'like', "%{$qstr}%");
            });
        }

        $tempatWisatas = $q->latest()->get()->map(function ($t) {
            $fotoUrl = ($t->photos && $t->photos->count())
                ? ($t->photos->first()->file_path ? Storage::url($t->photos->first()->file_path) : null)
                : null;

            return [
                'id'          => $t->id,
                'nama_tempat' => $t->nama_tempat,
                'alamat'      => $t->alamat,
                'latitude'    => $t->latitude,
                'longitude'   => $t->longitude,
                'kategori'    => $t->kategori,
                'tiket_masuk' => $t->tiket_masuk,
                'jam_buka'    => $t->jam_buka,
                'foto'        => $fotoUrl,
            ];
        })->toArray();

        return view('user.peta', [
            'tempatWisatas'  => $tempatWisatas,
            'activeKategori' => in_array($kat, $allowed, true) ? $kat : '',
            'searchQ'        => $qstr,
        ]);
    }


    /**
     * Public detail page for a tourist spot (accessible from map)
     */
    public function publicShow($id)
    {
        $tempat = TempatWisata::with(['photos', 'reviews', 'user'])->findOrFail($id);

        // URL foto publik
        $photos = $tempat->photos->map(fn($p) => $p->file_path ? Storage::url($p->file_path) : null)
            ->filter()->values()->toArray();

        // Rekomendasi guide: status approved dan spesialisasi == kategori tempat
        $rekomendasiGuides = TourGuide::where('status', 'approved')
            ->where('spesialisasi', $tempat->kategori) // 'alam' | 'kuliner' | 'budaya'
            ->latest()
            ->take(8)
            ->get(['id', 'nama', 'spesialisasi', 'pengalaman', 'kontak', 'foto']);

        return view('user.detailwisata', compact('tempat', 'photos', 'rekomendasiGuides'));
    }
}
