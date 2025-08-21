@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Conversation with {{ $otherUser->name }}</h1>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            @foreach ($messages as $message)
                <div class="mb-3 {{ $message->sender_id === auth()->id() ? 'text-end' : 'text-start' }}">
                    <div class="d-inline-block p-2 rounded {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 70%;">
                        <p class="mb-0">{{ $message->message }}</p>
                        <small class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}">{{ $message->created_at->format('g:i A') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ route('message.store') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
        <div class="input-group">
            <textarea class="form-control" name="message" rows="2" placeholder="Type your message..." required></textarea>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>
@endsection
