<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Barber;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function create(Barber $barber)
    {
        // Check if this barber belongs to the current user
        if (auth()->user()->id !== $barber->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('availability.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        // Check if this barber belongs to the current user
        if (auth()->user()->id !== $barber->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Availability::create([
            'barber_id' => $barber->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('barber.profile', $barber->id)->with('success', 'Availability added successfully!');
    }

    public function index(Barber $barber)
    {
        // Check if this barber belongs to the current user
        if (auth()->user()->id !== $barber->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $availabilities = $barber->availabilities()->orderBy('day_of_week')->orderBy('start_time')->get();

        return view('availability.index', compact('barber', 'availabilities'));
    }
}
