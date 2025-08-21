<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Appointment Confirmed')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your appointment at ' . $this->appointment->barber->shop_name . ' has been confirmed')
            ->line('Date & Time: ' . $this->appointment->appointment_time->format('F j, Y, g:i a'))
            ->action('View Appointment', route('appointment.index'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'message' => 'Your appointment at ' . $this->appointment->barber->shop_name . ' has been confirmed',
        ];
    }
}
