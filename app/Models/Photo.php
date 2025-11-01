<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'tempat_wisata_id',
        'event_id',
        'file_path',
        'keterangan',
    ];

    public function tempatWisata() { return $this->belongsTo(TempatWisata::class); }
    public function event() { return $this->belongsTo(Event::class); }
}
