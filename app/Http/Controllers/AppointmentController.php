<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;
use App\Notifications\AppointmentBooked;
use App\Notifications\AppointmentConfirmed;
use App\Notifications\AppointmentCancelled;

class AppointmentController extends Controller
{
    public function create(Barber $barber)
    {
        return view('appointment.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        $request->validate([
            'service' => 'required|string',
            'appointment_time' => 'required|date|after:now',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'barber_id' => $barber->id,
            'service' => $request->service,
            'appointment_time' => $request->appointment_time,
            'price' => $request->price,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Send notification to barber
        $barber->user->notify(new AppointmentBooked($appointment));

        return redirect()->route('appointment.show', $appointment->id)
            ->with('success', 'Appointment booked successfully! Please complete the payment to confirm.');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->barber) {
            // If the user is a barber, show appointments for their shop
            $appointments = Appointment::where('barber_id', $user->barber->id)
                ->orderBy('appointment_time', 'asc')
                ->get();
        } else {
            // If the user is a customer, show their appointments
            $appointments = Appointment::where('user_id', $user->id)
                ->orderBy('appointment_time', 'asc')
                ->get();
        }
        return view('appointment.index', compact('appointments'));
    }

    // Add this missing show method
    public function show(Appointment $appointment)
    {
        // Check if the user is authorized to view this appointment
        if ($appointment->user_id !== auth()->id() && ($appointment->barber_id !== auth()->user()->barber->id ?? null)) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('appointment.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        // Send notification based on status
        if ($request->status === 'confirmed') {
            $appointment->user->notify(new AppointmentConfirmed($appointment));
        } elseif ($request->status === 'cancelled') {
            $appointment->user->notify(new AppointmentCancelled($appointment));
        }

        return back()->with('success', 'Appointment status updated!');
    }
}
