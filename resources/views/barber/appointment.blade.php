@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Appointment Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Customer:</strong></div>
                        <div class="col-md-8">{{ $appointment->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Service:</strong></div>
                        <div class="col-md-8">{{ $appointment->service }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Date & Time:</strong></div>
                        <div class="col-md-8">{{ $appointment->appointment_time->format('F j, Y, g:i a') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Payment Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($appointment->payment_status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Price:</strong></div>
                        <div class="col-md-8">${{ number_format($appointment->price, 2) }}</div>
                    </div>
                    @if($appointment->notes)
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Notes:</strong></div>
                        <div class="col-md-8">{{ $appointment->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>

            @if($appointment->status == 'pending')
            <div class="card">
                <div class="card-header">
                    <h4>Update Appointment Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('barbers.appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Information</h4>
                </div>
                <div class="card-body">
                    <h5>{{ $appointment->user->name }}</h5>
                    <p><strong>Email:</strong> {{ $appointment->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $appointment->user->phone ?? 'Not provided' }}</p>

                    <div class="mt-3">
                        <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-outline-primary">View Full Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
