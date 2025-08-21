@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Messages</h1>
        </div>
    </div>

    @forelse ($conversations as $conversation)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">
                            @if ($conversation->sender_id === auth()->id())
                                {{ $conversation->receiver->name }}
                            @else
                                {{ $conversation->sender->name }}
                            @endif
                        </h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($conversation->message, 50) }}</p>
                    </div>
                    <div>
                        <small class="text-muted">{{ $conversation->created_at->format('M d, Y g:i A') }}</small>
                        <a href="{{ route('message.show', $conversation->sender_id === auth()->id() ? $conversation->receiver_id : $conversation->sender_id) }}" class="btn btn-primary btn-sm ms-2">View</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No conversations yet.
        </div>
    @endforelse
</div>
@endsection
