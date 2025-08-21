<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'barber_id',
        'image_path',
        'caption',
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
