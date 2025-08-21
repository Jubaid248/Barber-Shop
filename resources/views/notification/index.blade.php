@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Notifications</h1>
        </div>
    </div>

    @forelse (auth()->user()->notifications as $notification)
        <div class="card mb-3 {{ !$notification->read_at ? 'border-primary' : '' }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">{{ $notification->data['message'] }}</h5>
                        <p class="card-text text-muted">{{ $notification->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                    <div>
                        @if (!$notification->read_at)
                            <form action="{{ route('notification.markAsRead', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">Mark as Read</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No notifications.
        </div>
    @endforelse
</div>
@endsection
