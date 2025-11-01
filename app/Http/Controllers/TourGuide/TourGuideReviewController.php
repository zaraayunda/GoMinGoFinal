<?php
// app/Http/Controllers/TourGuide/TourGuideReviewController.php
namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\TourGuide;
use App\Models\TourGuideReview;
use Illuminate\Http\Request;

class TourGuideReviewController extends Controller
{
    public function store(Request $r, TourGuide $tourGuide)
    {
        // Opsional: hanya review TG approved
        if ($tourGuide->status !== 'approved') {
            return back()->with('error','Tour guide belum approved.');
        }

        $data = $r->validate([
            'user_name' => 'required|string|max:100',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'nullable|string|max:2000',
        ]);

        $data['tour_guide_id'] = $tourGuide->id;
        TourGuideReview::create($data);

        return back()->with('success','Terima kasih, review kamu sudah masuk!');
    }
}
