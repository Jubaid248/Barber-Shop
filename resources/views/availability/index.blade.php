@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Availability for {{ $barber->shop_name }}</h1>
        </div>
    </div>

    @if (auth()->id() === $barber->user_id)
        <div class="mb-4">
            <a href="{{ route('availability.create', $barber) }}" class="btn btn-primary">Add Availability</a>
        </div>
    @endif

    @forelse ($availabilities->groupBy('day_of_week') as $day => $times)
        <div class="card mb-4">
            <div class="card-header">
                {{ $day }}
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($times as $time)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $time->start_time->format('g:i A') }} - {{ $time->end_time->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No availability set.
        </div>
    @endforelse
</div>
@endsection
