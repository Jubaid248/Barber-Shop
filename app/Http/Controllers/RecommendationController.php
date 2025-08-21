<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function topRated()
    {
        $barbers = $this->recommendationService->getTopRatedBarbers();

        return view('recommendation.top_rated', compact('barbers'));
    }

    public function forUser()
    {
        $barbers = $this->recommendationService->getRecommendedBarbersForUser(auth()->user());

        return view('recommendation.for_user', compact('barbers'));
    }
}
