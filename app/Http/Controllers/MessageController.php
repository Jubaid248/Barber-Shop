<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewMessage;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get all conversations (unique users the current user has messaged with)
        $conversations = Message::where('sender_id', $user->id)
                                ->orWhere('receiver_id', $user->id)
                                ->with(['sender', 'receiver'])
                                ->orderBy('created_at', 'desc')
                                ->get()
                                ->groupBy(function ($message) use ($user) {
                                    return $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;
                                })
                                ->map(function ($group) {
                                    return $group->first();
                                });

        return view('message.index', compact('conversations'));
    }

    public function show($userId)
    {
        $user = auth()->user();
        $otherUser = User::findOrFail($userId);

        // Mark messages as read
        Message::where('sender_id', $otherUser->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

        // Get messages between the two users
        $messages = Message::where(function ($query) use ($user, $otherUser) {
                                $query->where('sender_id', $user->id)
                                    ->where('receiver_id', $otherUser->id);
                            })
                            ->orWhere(function ($query) use ($user, $otherUser) {
                                $query->where('sender_id', $otherUser->id)
                                    ->where('receiver_id', $user->id);
                            })
                            ->orderBy('created_at', 'asc')
                            ->get();

        return view('message.show', compact('messages', 'otherUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Send notification to receiver
        $receiver = User::find($request->receiver_id);
        $receiver->notify(new NewMessage($message));

        return back();
    }
}
