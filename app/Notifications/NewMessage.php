<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Message Received')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have received a new message from ' . $this->message->sender->name)
            ->line('Message: ' . \Illuminate\Support\Str::limit($this->message->message, 50))
            ->action('View Message', route('message.show', $this->message->sender_id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'message' => 'You have a new message from ' . $this->message->sender->name,
        ];
    }
}
