<?php
// app/Models/TourGuideReview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGuideReview extends Model
{
    protected $fillable = ['tour_guide_id','user_name','rating','komentar'];

    public function tourGuide() {
        return $this->belongsTo(TourGuide::class);
    }
}

