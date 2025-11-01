<?php
// app/Models/EventInvitation.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EventInvitation extends Model {
    protected $fillable = ['event_id','tour_guide_id','sent_at'];
    public function event(){ return $this->belongsTo(Event::class); }
    public function tourGuide(){ return $this->belongsTo(TourGuide::class); }
}
