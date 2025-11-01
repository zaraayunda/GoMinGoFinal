<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use App\Models\DetailTourGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\TourGuideReview;

class TourGuideController extends Controller
{
    /**
     * Display dashboard
     */
    public function dashboard()
    {
        return view('tour-guide.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourGuides = TourGuide::where('user_id', Auth::id())
            ->with('detailTourGuides')
            ->latest()
            ->get();

        // Cek apakah user sudah punya tour guide yang approved atau pending
        $canCreate = !TourGuide::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->exists();

        return view('tour-guide.index', compact('tourGuides', 'canCreate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek apakah user sudah punya tour guide yang approved atau pending
        $existingTourGuide = TourGuide::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        if ($existingTourGuide) {
            $statusText = $existingTourGuide->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
            return redirect()->route('tour-guide.index')
                ->with('error', "Anda sudah memiliki profil tour guide yang {$statusText}. Anda tidak dapat mendaftarkan profil baru hingga status profil saat ini berubah.");
        }

        return view('tour-guide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah punya tour guide yang approved atau pending
        $existingTourGuide = TourGuide::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        if ($existingTourGuide) {
            $statusText = $existingTourGuide->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
            return redirect()->route('tour-guide.index')
                ->with('error', "Anda sudah memiliki profil tour guide yang {$statusText}. Anda tidak dapat mendaftarkan profil baru hingga status profil saat ini berubah.");
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'spesialisasi' => 'required|in:alam,kuliner,budaya,campuran',
            'pengalaman' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
            'bahasa' => 'nullable|array',
            'bahasa.*' => 'nullable|string|max:100',
            'sertifikat' => 'required|array',
            'sertifikat.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
            'sertifikat_nama.*' => 'nullable|string|max:150',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 150 karakter',
            'spesialisasi.required' => 'Spesialisasi harus dipilih',
            'spesialisasi.in' => 'Spesialisasi tidak valid',
            'kontak.max' => 'Kontak maksimal 50 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 5MB',
            'bahasa.array' => 'Bahasa harus berupa array',
            'bahasa.*.string' => 'Bahasa harus berupa string',
            'bahasa.*.max' => 'Bahasa maksimal 100 karakter',
            'sertifikat.required' => 'Minimal satu sertifikat harus diupload',
            'sertifikat.array' => 'Sertifikat harus berupa array',
            'sertifikat.*.file' => 'Sertifikat harus berupa file',
            'sertifikat.*.mimes' => 'Format sertifikat harus PDF, JPG, JPEG, atau PNG',
            'sertifikat.*.max' => 'Ukuran file sertifikat maksimal 10MB',
            'sertifikat_nama.*.max' => 'Nama sertifikat maksimal 150 karakter',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('tour-guide/foto', $filename, 'public');
        }

        // Buat tour guide
        $tourGuide = TourGuide::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'spesialisasi' => $validated['spesialisasi'],
            'pengalaman' => $validated['pengalaman'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        // Simpan bahasa
        if ($request->filled('bahasa')) {
            foreach ($request->input('bahasa') as $bahasa) {
                if (!empty($bahasa)) {
                    DetailTourGuide::create([
                        'tour_guide_id' => $tourGuide->id,
                        'bahasa' => $bahasa,
                    ]);
                }
            }
        }

        // Upload dan simpan sertifikat
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $index => $sertifikatFile) {
                if ($sertifikatFile) {
                    $filename = time() . '_' . Str::random(10) . '_' . $index . '.' . $sertifikatFile->getClientOriginalExtension();
                    $sertifikatPath = $sertifikatFile->storeAs('tour-guide/sertifikat', $filename, 'public');

                    DetailTourGuide::create([
                        'tour_guide_id' => $tourGuide->id,
                        'sertifikat' => $sertifikatPath,
                        'sertifikat_nama' => $request->input("sertifikat_nama.{$index}") ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('tour-guide.index')
            ->with('success', 'Profil tour guide berhasil didaftarkan! Menunggu persetujuan admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tourGuide = TourGuide::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detailTourGuides')
            ->firstOrFail();

        return view('tour-guide.show', compact('tourGuide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tourGuide = TourGuide::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detailTourGuides')
            ->firstOrFail();

        return view('tour-guide.edit', compact('tourGuide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tourGuide = TourGuide::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detailTourGuides')
            ->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'spesialisasi' => 'required|in:alam,kuliner,budaya,campuran',
            'pengalaman' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'bahasa' => 'nullable|array',
            'bahasa.*' => 'nullable|string|max:100',
            'sertifikat' => 'nullable|array',
            'sertifikat.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'sertifikat_nama.*' => 'nullable|string|max:150',
            'detail_id' => 'nullable|array',
            'detail_id.*' => 'nullable|exists:detail_tour_guides,id',
            'delete_detail' => 'nullable|array',
            'delete_detail.*' => 'nullable|exists:detail_tour_guides,id',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 150 karakter',
            'spesialisasi.required' => 'Spesialisasi harus dipilih',
            'spesialisasi.in' => 'Spesialisasi tidak valid',
            'kontak.max' => 'Kontak maksimal 50 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 5MB',
            'bahasa.array' => 'Bahasa harus berupa array',
            'bahasa.*.string' => 'Bahasa harus berupa string',
            'bahasa.*.max' => 'Bahasa maksimal 100 karakter',
            'sertifikat.array' => 'Sertifikat harus berupa array',
            'sertifikat.*.file' => 'Sertifikat harus berupa file',
            'sertifikat.*.mimes' => 'Format sertifikat harus PDF, JPG, JPEG, atau PNG',
            'sertifikat.*.max' => 'Ukuran file sertifikat maksimal 10MB',
            'sertifikat_nama.*.max' => 'Nama sertifikat maksimal 150 karakter',
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'spesialisasi' => $validated['spesialisasi'],
            'pengalaman' => $validated['pengalaman'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
        ];

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tourGuide->foto) {
                Storage::disk('public')->delete($tourGuide->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('tour-guide/foto', $filename, 'public');
            $updateData['foto'] = $fotoPath;
        }

        // Update tour guide
        $tourGuide->update($updateData);

        // Hapus detail yang diminta
        if ($request->filled('delete_detail')) {
            foreach ($request->input('delete_detail') as $detailId) {
                $detail = DetailTourGuide::where('id', $detailId)
                    ->where('tour_guide_id', $tourGuide->id)
                    ->first();

                if ($detail) {
                    // Hapus file sertifikat jika ada
                    if ($detail->sertifikat) {
                        Storage::disk('public')->delete($detail->sertifikat);
                    }
                    $detail->delete();
                }
            }
        }

        // Update bahasa yang sudah ada
        if ($request->filled('detail_id') && $request->filled('bahasa')) {
            foreach ($request->input('detail_id') as $index => $detailId) {
                if ($detailId && isset($request->input('bahasa')[$index])) {
                    $detail = DetailTourGuide::where('id', $detailId)
                        ->where('tour_guide_id', $tourGuide->id)
                        ->first();

                    if ($detail) {
                        $detail->update([
                            'bahasa' => $request->input('bahasa')[$index] ?? null,
                        ]);
                    }
                }
            }
        }

        // Tambah bahasa baru
        if ($request->filled('bahasa')) {
            foreach ($request->input('bahasa') as $index => $bahasa) {
                if (!empty($bahasa)) {
                    // Cek apakah detail_id tidak ada untuk index ini (berarti baru)
                    $detailId = $request->input("detail_id.{$index}") ?? null;
                    if (!$detailId) {
                        DetailTourGuide::create([
                            'tour_guide_id' => $tourGuide->id,
                            'bahasa' => $bahasa,
                        ]);
                    }
                }
            }
        }

        // Upload sertifikat baru jika ada
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $index => $sertifikatFile) {
                if ($sertifikatFile) {
                    $filename = time() . '_' . Str::random(10) . '_' . $index . '.' . $sertifikatFile->getClientOriginalExtension();
                    $sertifikatPath = $sertifikatFile->storeAs('tour-guide/sertifikat', $filename, 'public');

                    DetailTourGuide::create([
                        'tour_guide_id' => $tourGuide->id,
                        'sertifikat' => $sertifikatPath,
                        'sertifikat_nama' => $request->input("sertifikat_nama.{$index}") ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('tour-guide.index')
            ->with('success', 'Profil tour guide berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tourGuide = TourGuide::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detailTourGuides')
            ->firstOrFail();

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

        // Hapus detail akan otomatis terhapus karena onDelete('cascade')
        $tourGuide->delete();

        return redirect()->route('tour-guide.index')
            ->with('success', 'Profil tour guide berhasil dihapus!');
    }

    public function publicShow($id)
    {
        $guide = TourGuide::with(['detailTourGuides', 'reviews' => function ($q) {
            $q->latest(); // urut terbaru
        }])->findOrFail($id);

        // Foto -> URL publik
        $foto = $guide->foto ?? null;
        if ($foto && !preg_match('#^https?://#i', $foto)) {
            $foto = Storage::url($foto);
        }
        $guide->foto_url = $foto ?: asset('assets/img/tourguide/default.png');

        // Format WA
        $hp = preg_replace('/\D+/', '', (string)($guide->kontak ?? ''));
        if ($hp && substr($hp, 0, 1) === '0') $hp = '62' . substr($hp, 1);
        $guide->wa_link = $hp ? "https://wa.me/{$hp}" : null;

        // Ringkasan detail
        $bahasa     = optional($guide->detailTourGuides)->pluck('bahasa')->filter()->unique()->values();
        $sertifikat = optional($guide->detailTourGuides)->pluck('sertifikat_nama')->filter()->unique()->values();

        // === Ringkasan review
        $avgRating    = round((float) $guide->reviews()->avg('rating'), 1);
        $reviewsCount = (int) $guide->reviews()->count();

        return view('user.tourguide-detail', [
            'guide'        => $guide,
            'bahasa'       => $bahasa,
            'sertifikat'   => $sertifikat,
            'avgRating'    => $avgRating,
            'reviewsCount' => $reviewsCount,
            'reviews'      => $guide->reviews, // sudah di-eager load
        ]);
    }


    public function publicIndex(\Illuminate\Http\Request $r)
    {
        $q   = trim((string)$r->query('q', ''));                   // pencarian nama
        $sp  = strtolower((string)$r->query('spesialisasi', '')); // alam|kuliner|budaya|''

        $guides = TourGuide::query()
            ->whereIn('status', ['approved', 'aktif', 'active'])
            ->when($q, fn($x) => $x->where('nama', 'like', "%{$q}%"))
            ->when(
                in_array($sp, ['alam', 'kuliner', 'budaya']),
                fn($x) => $x->where('spesialisasi', $sp)
            )
            ->latest()
            ->paginate(12)     // pagination
            ->withQueryString();

        // map foto & wa
        $guides->getCollection()->transform(function ($g) {
            $foto = $g->foto ?? null;
            if ($foto && !preg_match('#^https?://#i', $foto)) $foto = Storage::url($foto);
            $g->foto_url = $foto ?: asset('assets/img/tourguide/default.png');

            $hp = preg_replace('/\D+/', '', (string)($g->kontak ?? ''));
            if ($hp && $hp[0] === '0') $hp = '62' . substr($hp, 1);
            $g->wa_link = $hp ? "https://wa.me/{$hp}" : null;
            return $g;
        });

        return view('user.tourguide', [
            'guides' => $guides,
            'sp'     => $sp,
            'q'      => $q,
        ]);
    }
}
