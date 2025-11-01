<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_guide_id',
        'bahasa',
        'sertifikat',
        'sertifikat_nama',
    ];

    public function tourGuide()
    {
        return $this->belongsTo(TourGuide::class);
    }
}
