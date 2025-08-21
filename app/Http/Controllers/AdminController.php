<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'barbers' => Barber::count(),
            'appointments' => Appointment::count(),
            'pendingAppointments' => Appointment::where('status', 'pending')->count(),
        ];

        $recentAppointments = Appointment::with(['user', 'barber'])
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function barbers()
    {
        $barbers = Barber::with('user')->latest()->paginate(10);
        return view('admin.barbers', compact('barbers'));
    }

    public function appointments()
    {
        $appointments = Appointment::with(['user', 'barber'])->latest()->paginate(10);
        return view('admin.appointments', compact('appointments'));
    }

    public function toggleAdmin($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'User admin status updated.');
    }
}
