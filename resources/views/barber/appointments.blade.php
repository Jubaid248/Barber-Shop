@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>My Appointments</h1>
        </div>
    </div>

    @forelse ($appointments as $appointment)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5>{{ $appointment->user->name }}</h5>
                        <p class="mb-1"><strong>Service:</strong> {{ $appointment->service }}</p>
                        <p class="mb-1"><strong>Date & Time:</strong> {{ $appointment->appointment_time->format('F j, Y, g:i a') }}</p>
                        <p class="mb-1">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : ($appointment->status == 'completed' ? 'info' : 'warning')) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </p>
                        <p class="mb-1">
                            <strong>Payment:</strong>
                            <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($appointment->payment_status) }}
                            </span>
                        </p>
                        <p class="mb-1"><strong>Price:</strong> ${{ number_format($appointment->price, 2) }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('barbers.appointments.show', $appointment->id) }}" class="btn btn-primary mb-2">View Details</a>
                        @if($appointment->status == 'pending')
                            <form action="{{ route('barbers.appointments.confirm', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            You don't have any appointments yet.
        </div>
    @endforelse
</div>
@endsection
