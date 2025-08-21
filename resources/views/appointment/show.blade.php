@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('appointment.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Appointments
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Appointment Details -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-500 to-purple-600">
                        <h2 class="text-xl font-bold text-white">Appointment Details</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Information</h3>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Barber</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $appointment->barber->shop_name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Service</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $appointment->service }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $appointment->appointment_time->format('F j, Y, g:i a') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Price</dt>
                                        <dd class="mt-1 text-sm text-gray-900">${{ number_format($appointment->price, 2) }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Appointment Status</dt>
                                        <dd class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                                        <dd class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $appointment->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($appointment->payment_status) }}
                                            </span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        @if($appointment->notes)
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Notes</h3>
                                <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg">{{ $appointment->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Section -->
                @if($appointment->payment_status == 'unpaid')
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-500 to-emerald-600">
                            <h2 class="text-xl font-bold text-white">Complete Payment</h2>
                        </div>

                        <div class="p-6">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Please complete your payment to confirm this appointment.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Payment Summary</h3>
                                    <p class="text-2xl font-bold text-gray-900">${{ number_format($appointment->price, 2) }}</p>
                                </div>
                                <a href="{{ route('payment.checkout', $appointment->id) }}" class="mt-4 sm:mt-0 btn-primary text-white px-6 py-3 rounded-full">
                                    <i class="fas fa-credit-card mr-2"></i> Pay Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Barber Information -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">Barber Information</h2>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-cut text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $appointment->barber->shop_name }}</h3>
                                <p class="text-sm text-gray-600">{{ $appointment->barber->address }}</p>
                            </div>
                        </div>

                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900">{{ $appointment->barber->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="text-sm text-gray-900">{{ $appointment->barber->description }}</dd>
                            </div>
                        </dl>

                        <div class="mt-6">
                            <a href="{{ route('barber.profile', $appointment->barber->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-external-link-alt mr-2"></i> View Full Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">Actions</h2>
                    </div>

                    <div class="p-6 space-y-3">
                        @if (auth()->user()->barber)
                            @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointment.update.status', $appointment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fas fa-check mr-2"></i> Confirm Appointment
                                    </button>
                                </form>
                            @endif
                        @else
                            @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointment.update.status', $appointment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-times mr-2"></i> Cancel Appointment
                                    </button>
                                </form>
                            @endif
                        @endif

                        <a href="{{ route('message.show', $appointment->barber->user_id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-comment mr-2"></i> Send Message
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
