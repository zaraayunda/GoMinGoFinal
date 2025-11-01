<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_email',
        'tempat_wisata_id',
    ];
    public function tempatWisata() { return $this->belongsTo(TempatWisata::class); }
}
