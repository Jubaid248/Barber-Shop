<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('search.index', compact('services'));
    }

    public function results(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'distance' => 'nullable|integer|min:1|max:100',
            'service' => 'nullable|exists:services,id',
            'min_rating' => 'nullable|integer|min:1|max:5',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
        ]);

        $location = $request->location;
        $distance = $request->distance ?? 25; // Default 25km

        // Start with a basic search by address
        $query = Barber::where('address', 'like', '%' . $location . '%');

        // Filter by service if provided
        if ($request->filled('service')) {
            $serviceId = $request->service;
            $query->whereHas('services', function ($q) use ($serviceId) {
                $q->where('service_id', $serviceId);
            });
        }

        // Filter by minimum rating if provided
        if ($request->filled('min_rating')) {
            $minRating = $request->min_rating;
            $query->withAvg('reviews', 'rating')
                  ->having('reviews_avg_rating', '>=', $minRating);
        }

        // Filter by price range if provided
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('services', function ($q) use ($request) {
                if ($request->filled('min_price')) {
                    $q->where('price', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $q->where('price', '<=', $request->max_price);
                }
            });
        }

        $barbers = $query->get();

        return view('search.results', compact('barbers', 'location', 'distance'));
    }
}
