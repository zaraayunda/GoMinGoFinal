<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_event',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'latitude',
        'longitude',
        'foto',
        'status',
        'tempat_wisata_id'
    ];

    public function photos() { return $this->hasMany(Photo::class); }

    public function invitations() { return $this->hasMany(\App\Models\EventInvitation::class); }
    public function registrations(){ return $this->hasMany(\App\Models\EventRegistration::class); }

}
