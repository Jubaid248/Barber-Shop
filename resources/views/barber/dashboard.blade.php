@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Barber Dashboard</h1>
            <p class="text-gray-700 mt-2 text-lg">Welcome back, {{ auth()->user()->name }}! Manage your appointments and business.</p>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center">
                    <div class="rounded-full bg-white/20 backdrop-blur-sm p-4">
                        <i class="fas fa-calendar-check text-3xl text-blue-100"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-blue-100">Total Appointments</p>
                        <p class="text-3xl font-bold text-white">{{ $appointments->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center">
                    <div class="rounded-full bg-white/20 backdrop-blur-sm p-4">
                        <i class="fas fa-check-circle text-3xl text-green-100"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-green-100">Confirmed</p>
                        <p class="text-3xl font-bold text-white">{{ $appointments->where('status', 'confirmed')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 via-yellow-600 to-yellow-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-yellow-400/20">
                <div class="flex items-center">
                    <div class="rounded-full bg-white/20 backdrop-blur-sm p-4">
                        <i class="fas fa-clock text-3xl text-yellow-100"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-yellow-100">Pending</p>
                        <p class="text-3xl font-bold text-white">{{ $appointments->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20">
                <div class="flex items-center">
                    <div class="rounded-full bg-white/20 backdrop-blur-sm p-4">
                        <i class="fas fa-dollar-sign text-3xl text-purple-100"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-purple-100">Revenue</p>
                        <p class="text-3xl font-bold text-white">${{ number_format($appointments->where('payment_status', 'paid')->sum('price'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointments Table -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
            <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Recent Appointments</h2>
                        <p class="text-base text-gray-700 font-medium">Manage your upcoming appointments</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                        <a href="{{ route('barbers.appointments.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-list mr-2"></i> View All Appointments
                        </a>
                        @if(auth()->user()->barber)
                            <a href="{{ route('availability.index', auth()->user()->barber->id) }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-calendar-plus mr-2"></i> Manage Availability
                            </a>
                            <a href="{{ route('photo.create', auth()->user()->barber->id) }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-camera mr-2"></i> Manage Photos
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-600">
                    <thead class="bg-gradient-to-r from-gray-700 to-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Payment</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-600">
                        @foreach($appointments as $appointment)
                            <tr class="hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $appointment->user->name }}</div>
                                            <div class="text-sm text-gray-300">{{ $appointment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ $appointment->service }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ $appointment->appointment_time->format('M j, Y g:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">
                                    ${{ number_format($appointment->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('barbers.appointments.show', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($appointment->status == 'pending')
                                            <form action="{{ route('barbers.appointments.confirm', $appointment->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('message.show', $appointment->user->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-comment"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($appointments->count() == 0)
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-white mb-2">No appointments yet</h3>
                    <p class="text-gray-300 mb-6">You don't have any appointments scheduled.</p>
                    @if(auth()->user()->barber)
                        <a href="{{ route('availability.index', auth()->user()->barber->id) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-calendar-plus mr-2"></i> Set Your Availability
                        </a>
                    @else
                        <a href="{{ route('availability.create', auth()->user()->barber->id ?? 0) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-calendar-plus mr-2"></i> Set Your Availability
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
