<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Barber;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function create(Barber $barber)
    {
        // Only allow the barber owner to create availability
        if (auth()->id() !== $barber->user_id) {
            abort(403);
        }

        return view('availability.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        // Only allow the barber owner to create availability
        if (auth()->id() !== $barber->user_id) {
            abort(403);
        }

        $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Availability::create([
            'barber_id' => $barber->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('barber.profile', $barber)->with('success', 'Availability added successfully!');
    }

    public function index(Barber $barber)
    {
        $availabilities = $barber->availabilities()->orderBy('day_of_week')->orderBy('start_time')->get();

        return view('availability.index', compact('barber', 'availabilities'));
    }
}
