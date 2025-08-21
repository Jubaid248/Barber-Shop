@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Reviews for {{ $barber->shop_name }}</h1>
            <p class="lead">Average Rating: {{ number_format($averageRating, 1) }} / 5</p>
            <div class="alert alert-info">
                <strong>AI Summary:</strong> {{ $aiSummary }}
            </div>
        </div>
    </div>

    @forelse ($reviews as $review)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">{{ $review->user->name }}</h5>
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <span class="text-warning">&#9733;</span>
                                @else
                                    <span class="text-secondary">&#9734;</span>
                                @endif
                            @endfor
                        </div>
                        <p class="card-text">{{ $review->review }}</p>
                    </div>
                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No reviews yet.
        </div>
    @endforelse
</div>
@endsection
