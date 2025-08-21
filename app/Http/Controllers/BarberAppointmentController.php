<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class BarberAppointmentController extends Controller
{
    /**
     * Display a listing of the barber's appointments.
     */
    public function index()
    {
        $barber = auth()->user()->barber;
        $appointments = Appointment::where('barber_id', $barber->id)
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('barber.appointments', compact('appointments'));
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        // Check if this appointment belongs to the current barber
        if ($appointment->barber_id !== auth()->user()->barber->id) {
            return redirect()->route('barber.dashboard')->with('error', 'Unauthorized access.');
        }

        return view('barber.appointment', compact('appointment'));
    }

    /**
     * Update the specified appointment.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Check if this appointment belongs to the current barber
        if ($appointment->barber_id !== auth()->user()->barber->id) {
            return redirect()->route('barber.dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        return redirect()->route('barbers.appointments.show', $appointment->id)
            ->with('success', 'Appointment status updated successfully!');
    }

    /**
     * Confirm the specified appointment.
     */
    public function confirm(Appointment $appointment)
    {
        // Check if this appointment belongs to the current barber
        if ($appointment->barber_id !== auth()->user()->barber->id) {
            return redirect()->route('barber.dashboard')->with('error', 'Unauthorized access.');
        }

        $appointment->update([
            'status' => 'confirmed',
        ]);

        return redirect()->route('barbers.appointments.show', $appointment->id)
            ->with('success', 'Appointment confirmed successfully!');
    }
}
