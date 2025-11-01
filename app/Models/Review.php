<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'tempat_wisata_id',
        'user_name',
        'rating',
        'komentar',
    ];
    public function tempatWisata() { return $this->belongsTo(TempatWisata::class); }
}
