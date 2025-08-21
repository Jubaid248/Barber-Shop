@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Recommended For You</h1>
            <p class="lead">Barbers we think you'll love based on your preferences</p>
        </div>
    </div>

    @forelse ($barbers as $barber)
        <div class="card mb-4 barber-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title">{{ $barber->shop_name }}</h5>
                        <p class="card-text">{{ $barber->description }}</p>
                        <p class="card-text">
                            <strong>Address:</strong> {{ $barber->address }}<br>
                            <strong>Phone:</strong> {{ $barber->phone }}
                        </p>
                        <p class="card-text">
                            <strong>Rating:</strong>
                            {{ number_format($barber->reviews_avg_rating, 1) }} / 5
                            ({{ $barber->reviews->count() }} reviews)
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <form method="POST" action="{{ route('favorite.store', $barber) }}" class="d-inline mb-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-star"></i> Favorite
                            </button>
                        </form>
                        <a href="{{ route('barber.profile', $barber) }}" class="btn btn-outline-primary">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No recommendations available. Try favoriting some barbers first.
        </div>
    @endforelse
</div>
@endsection
