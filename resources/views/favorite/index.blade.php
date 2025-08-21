@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>My Favorite Barbers</h1>
        </div>
    </div>

    @forelse ($favorites as $barber)
        <div class="card mb-4 barber-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-3">
                            @if ($barber->profile_image)
                                <img src="{{ asset('storage/' . $barber->profile_image) }}" alt="{{ $barber->shop_name }}" class="rounded-circle me-3" width="80" height="80">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $barber->shop_name }}" class="rounded-circle me-3" width="80" height="80">
                            @endif
                            <div>
                                <h5 class="card-title">{{ $barber->shop_name }}</h5>
                                <p class="card-text">{{ $barber->description }}</p>
                            </div>
                        </div>
                        <p class="card-text">
                            <strong>Address:</strong> {{ $barber->address }}<br>
                            <strong>Phone:</strong> {{ $barber->phone }}
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <form method="POST" action="{{ route('favorite.destroy', $barber) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Remove from Favorites</button>
                        </form>
                        <a href="{{ route('barber.profile', $barber) }}" class="btn btn-outline-primary mt-2">View Profile</a>
                        <a href="{{ route('appointment.create', $barber) }}" class="btn btn-primary mt-2">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            You haven't added any barbers to your favorites yet.
        </div>
    @endforelse
</div>
@endsection
