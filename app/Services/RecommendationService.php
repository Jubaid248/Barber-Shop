<?php

namespace App\Services;

use App\Models\Barber;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function getTopRatedBarbers($limit = 5)
    {
        // Get all barbers with their average rating
        $barbers = Barber::all()->map(function ($barber) {
            $barber->average_rating = $barber->reviews()->avg('rating') ?: 0;
            return $barber;
        });

        // Filter by rating and sort
        return $barbers->filter(function ($barber) {
            return $barber->average_rating >= 4;
        })->sortByDesc('average_rating')->take($limit);
    }

    public function getRecommendedBarbersForUser(User $user, $limit = 5)
    {
        // Get barbers in the user's favorite services
        $favoriteServiceIds = $user->favoriteBarbers()
                                   ->with('services')
                                   ->get()
                                   ->pluck('services')
                                   ->flatten()
                                   ->pluck('id')
                                   ->unique();

        if ($favoriteServiceIds->isEmpty()) {
            // If no favorites, return top rated barbers
            return $this->getTopRatedBarbers($limit);
        }

        // Get barbers with the favorite services
        $barbers = Barber::whereHas('services', function ($query) use ($favoriteServiceIds) {
                    $query->whereIn('service_id', $favoriteServiceIds);
                })->get()->map(function ($barber) {
                    $barber->average_rating = $barber->reviews()->avg('rating') ?: 0;
                    return $barber;
                });

        // Sort by rating
        return $barbers->sortByDesc('average_rating')->take($limit);
    }
}
