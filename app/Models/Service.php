<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_price',
        'max_price',
    ];

    public function barbers()
    {
        return $this->belongsToMany(Barber::class, 'barber_service')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
