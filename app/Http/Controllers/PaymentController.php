<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Verify this appointment belongs to the current user
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Skip Stripe integration for testing
        // Just redirect to success page directly
        return redirect()->route('payment.success', ['appointmentId' => $appointment->id]);
    }

    public function success($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Verify this appointment belongs to the current user
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Update appointment status to paid
        $appointment->payment_status = 'paid';
        $appointment->status = 'confirmed';
        $appointment->save();

        return redirect()->route('appointment.show', $appointment->id)->with('success', 'Payment successful! Your appointment is confirmed.');
    }

    public function cancel($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Verify this appointment belongs to the current user
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Keep appointment as unpaid but let user know payment was cancelled
        return redirect()->route('appointment.show', $appointment->id)->with('error', 'Payment was cancelled. Your appointment is still pending payment.');
    }
}
