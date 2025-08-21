<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Barber $barber)
    {
        return view('review.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        // Check if user already reviewed this barber
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('barber_id', $barber->id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this barber.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'barber_id' => $barber->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('barber.profile', $barber)->with('success', 'Review submitted successfully!');
    }

    public function index(Barber $barber)
    {
        $reviews = $barber->reviews()->with('user')->latest()->get();
        $averageRating = $barber->averageRating();

        // Simulate AI summary (in a real app, you would use an AI service)
        $aiSummary = $this->generateAISummary($reviews);

        return view('review.index', compact('barber', 'reviews', 'averageRating', 'aiSummary'));
    }

    // Simulated AI summary function
    private function generateAISummary($reviews)
    {
        if ($reviews->isEmpty()) {
            return 'No reviews yet.';
        }

        // Simple summary: count of positive and negative reviews
        $positive = $reviews->where('rating', '>=', 4)->count();
        $negative = $reviews->where('rating', '<=', 2)->count();
        $neutral = $reviews->count() - $positive - $negative;

        $summary = "Based on {$reviews->count()} reviews: ";
        if ($positive > 0) {
            $summary .= "$positive positive, ";
        }
        if ($neutral > 0) {
            $summary .= "$neutral neutral, ";
        }
        if ($negative > 0) {
            $summary .= "$negative negative. ";
        }

        $summary .= "Overall, customers are " . ($positive > $negative ? 'satisfied' : 'not satisfied') . " with the service.";

        return $summary;
    }
}
