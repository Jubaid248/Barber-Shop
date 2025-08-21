<?php

use App\Services\RecommendationService;

if (!function_exists('getTopRatedBarbers')) {
    function getTopRatedBarbers($limit = 5)
    {
        $recommendationService = app(RecommendationService::class);
        return $recommendationService->getTopRatedBarbers($limit);
    }
}

if (!function_exists('getRecommendedBarbersForUser')) {
    function getRecommendedBarbersForUser($user, $limit = 5)
    {
        $recommendationService = app(RecommendationService::class);
        return $recommendationService->getRecommendedBarbersForUser($user, $limit);
    }
}
