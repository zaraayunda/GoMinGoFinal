<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGuideSchedule extends Model
{
    protected $fillable = [
        'tour_guide_id',
        'start_at',
        'end_at',
        'status',
        'title',
        'location',
        'note'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
    ];

    public function tourGuide()
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function guide()
    {
        return $this->belongsTo(\App\Models\TourGuide::class, 'tour_guide_id');
    }
}
