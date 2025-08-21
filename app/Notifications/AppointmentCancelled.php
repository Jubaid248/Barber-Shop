<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCancelled extends Notification implements ShouldQueue
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
            ->subject('Appointment Cancelled')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your appointment at ' . $this->appointment->barber->shop_name . ' has been cancelled')
            ->line('Date & Time: ' . $this->appointment->appointment_time->format('F j, Y, g:i a'))
            ->action('View Appointments', route('appointment.index'))
            ->line('We apologize for any inconvenience.');
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'message' => 'Your appointment at ' . $this->appointment->barber->shop_name . ' has been cancelled',
        ];
    }
}
