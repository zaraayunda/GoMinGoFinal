<?php
// app/Models/EventRegistration.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model {
    protected $fillable = ['event_id','tour_guide_id','status','catatan'];
    public function event(){ return $this->belongsTo(Event::class); }
    public function tourGuide(){ return $this->belongsTo(\App\Models\TourGuide::class); }
    public function scopeApproved($q){ return $q->where('status','approved'); }
}
