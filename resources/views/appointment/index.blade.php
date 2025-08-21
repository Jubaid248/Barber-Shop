@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Appointments</h1>
            <p class="text-gray-600 mt-2">Manage all your appointments in one place</p>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">All Appointments</h2>
                        <p class="text-sm text-gray-500">{{ $appointments->count() }} appointments found</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('search.index') }}" class="btn-primary text-white px-4 py-2 rounded-full">
                            <i class="fas fa-plus mr-2"></i> Book New Appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-200">
                @forelse ($appointments as $appointment)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex-1">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-cut text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            @if (auth()->user()->barber)
                                                Appointment with {{ $appointment->user->name }}
                                            @else
                                                Appointment at {{ $appointment->barber->shop_name }}
                                            @endif
                                        </h3>
                                        <div class="mt-1 flex flex-wrap gap-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                <i class="fas fa-calendar-day mr-1"></i> {{ $appointment->appointment_time->format('M j, Y g:i A') }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                <i class="fas fa-credit-card mr-1"></i> {{ ucfirst($appointment->payment_status) }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i class="fas fa-tag mr-1"></i> ${{ number_format($appointment->price, 2) }}
                                            </span>
                                        </div>
                                        @if ($appointment->notes)
                                            <p class="mt-2 text-sm text-gray-600">
                                                <i class="fas fa-sticky-note mr-1"></i> {{ $appointment->notes }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('appointment.show', $appointment->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-eye mr-2"></i> View
                                </a>

                                @if (auth()->user()->barber)
                                    <form method="POST" action="{{ route('appointment.update.status', $appointment) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="mt-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Update
                                        </button>
                                    </form>
                                @else
                                    @if ($appointment->status === 'pending')
                                        <form method="POST" action="{{ route('appointment.update.status', $appointment) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <i class="fas fa-times mr-2"></i> Cancel
                                            </button>
                                        </form>
                                    @endif

                                    @if ($appointment->payment_status === 'unpaid')
                                        <a href="{{ route('payment.checkout', $appointment->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <i class="fas fa-credit-card mr-2"></i> Pay Now
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No appointments found</h3>
                        <p class="text-gray-500 mb-6">You don't have any appointments yet.</p>
                        <a href="{{ route('search.index') }}" class="btn-primary text-white px-6 py-3 rounded-full">
                            <i class="fas fa-search mr-2"></i> Find Barbers
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
