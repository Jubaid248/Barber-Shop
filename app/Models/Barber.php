<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'description',
        'address',
        'phone',
        'latitude',
        'longitude',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function profileImage()
    {
        return $this->hasOne(Photo::class)->where('is_profile', true);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Accessors
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getMinPriceAttribute()
    {
        // This is a placeholder - in a real app, you might have a services table
        return 15; // Minimum price for services
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profileImage) {
            return asset('storage/' . $this->profileImage->image_path);
        }
        return asset('images/default-barber.jpg');
    }
}
