<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'spesialisasi',
        'pengalaman',
        'kontak',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTourGuides()
    {
        return $this->hasMany(DetailTourGuide::class);
    }

    public function scopeApproved($q)
    {
        return $q->where('status', 'approved');
    }

    public function invitations()
    {
        return $this->hasMany(\App\Models\EventInvitation::class);
    }
    public function registrations()
    {
        return $this->hasMany(\App\Models\EventRegistration::class);
    }

    // app/Models/TourGuide.php
    public function reviews()
    {
        return $this->hasMany(\App\Models\TourGuideReview::class);
    }

    public function schedules()
    {
        return $this->hasMany(\App\Models\TourGuideSchedule::class);
    }
}
