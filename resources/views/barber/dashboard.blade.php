@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Barber Dashboard</h1>
            <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}! Manage your appointments and business.</p>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow p-6 text-white">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-400 p-3">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">Total Appointments</p>
                        <p class="text-2xl font-bold">{{ $appointments->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow p-6 text-white">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-400 p-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">Confirmed</p>
                        <p class="text-2xl font-bold">{{ $appointments->where('status', 'confirmed')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow p-6 text-white">
                <div class="flex items-center">
                    <div class="rounded-full bg-yellow-400 p-3">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">Pending</p>
                        <p class="text-2xl font-bold">{{ $appointments->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow p-6 text-white">
                <div class="flex items-center">
                    <div class="rounded-full bg-purple-400 p-3">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium">Revenue</p>
                        <p class="text-2xl font-bold">${{ number_format($appointments->where('payment_status', 'paid')->sum('price'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointments Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Recent Appointments</h2>
                        <p class="text-sm text-gray-500">Manage your upcoming appointments</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                        <a href="{{ route('barbers.appointments.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full transition duration-300">
                            <i class="fas fa-list mr-2"></i> View All Appointments
                        </a>
                        <a href="{{ route('availability.index', auth()->user()->barber->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full transition duration-300">
                            <i class="fas fa-calendar-plus mr-2"></i> Manage Availability
                        </a>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <i class="fas fa-user text-indigo-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $appointment->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $appointment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $appointment->service }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $appointment->appointment_time->format('M j, Y g:i A') }}</div>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
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
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No appointments yet</h3>
                    <p class="text-gray-500 mb-6">You don't have any appointments scheduled.</p>
                    <a href="{{ route('availability.index', auth()->user()->barber->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-full transition duration-300">
                        <i class="fas fa-calendar-plus mr-2"></i> Set Your Availability
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
