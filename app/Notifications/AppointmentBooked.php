<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBooked extends Notification implements ShouldQueue
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
            ->subject('New Appointment Booked')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have a new appointment booked at ' . $this->appointment->barber->shop_name)
            ->line('Date & Time: ' . $this->appointment->appointment_time->format('F j, Y, g:i a'))
            ->line('Customer: ' . $this->appointment->user->name)
            ->action('View Appointments', route('appointment.index'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'message' => 'You have a new appointment booked at ' . $this->appointment->barber->shop_name,
        ];
    }
}
