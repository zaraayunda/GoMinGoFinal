<?php
// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $r, TempatWisata $tempat)
    {
        $data = $r->validate([
            'user_name' => 'required|string|max:100',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'nullable|string|max:2000',
        ]);

        $data['tempat_wisata_id'] = $tempat->id;
        Review::create($data);

        return back()->with('success', 'Terima kasih! Review kamu tersimpan.');
    }
}
