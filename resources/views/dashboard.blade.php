@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">DASHBOARD</h1>
            <p class="text-gray-600 text-lg">Welcome back, {{ auth()->user()->name }}</p>


        </div>

        @if (session('status'))
            <div class="mb-6 bg-card border border-green-500 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-400">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quick Actions -->
                <div class="card p-6 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-600">
                    <h2 class="text-xl font-bold mb-4 text-white">QUICK ACTIONS</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @if(!auth()->user()->barber)
                            <a href="{{ route('barber.create') }}" class="quick-action-card bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fas fa-plus-circle text-2xl"></i>
                                <p class="font-semibold">CREATE BARBER PROFILE</p>
                            </a>
                        @endif

                        <a href="{{ route('search.index') }}" class="quick-action-card bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-search text-2xl"></i>
                            <p class="font-semibold">FIND BARBERS</p>
                        </a>

                        <a href="{{ route('appointment.index') }}" class="quick-action-card bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                            <p class="font-semibold">MY APPOINTMENTS</p>
                            </a>

                        <a href="{{ route('favorite.index') }}" class="quick-action-card bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-heart text-2xl"></i>
                            <p class="font-semibold">MY FAVORITES</p>
                        </a>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <div class="card p-6 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-600">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-white">RECENT APPOINTMENTS</h2>
                        <a href="{{ route('appointment.index') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">VIEW ALL</a>
                    </div>

                    @if(auth()->user()->appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach(auth()->user()->appointments->take(3) as $appointment)
                                <div class="border-b border-gray-600 pb-4 last:border-0 last:pb-0">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-semibold text-white">{{ $appointment->barber->shop_name }}</h3>
                                            <p class="text-sm text-gray-300">{{ $appointment->appointment_time->format('M j, Y g:i A') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->status == 'confirmed' ? 'bg-green-900 text-green-400' : ($appointment->status == 'pending' ? 'bg-yellow-900 text-yellow-400' : ($appointment->status == 'cancelled' ? 'bg-red-900 text-red-400' : 'bg-blue-900 text-blue-400')) }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            <p class="text-sm text-gray-300 mt-1">${{ number_format($appointment->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-400 text-4xl mb-3"></i>
                            <p class="text-gray-300">You don't have any appointments yet.</p>
                            <a href="{{ route('search.index') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-block">FIND BARBERS</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- User Profile Card -->
                <div class="card p-6 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-600">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-white text-lg">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-300">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    @if(auth()->user()->barber)
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 mb-4 border border-green-400/20">
                            <p class="text-sm text-white font-semibold">YOU'RE A BARBER!</p>
                            <a href="{{ route('barber.dashboard') }}" class="text-green-100 text-sm hover:text-white transition-colors">GO TO BARBER DASHBOARD →</a>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" class="w-full bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white py-3 px-4 rounded-lg transition-all duration-300 font-semibold block text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-user-edit mr-2"></i>EDIT PROFILE
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 px-4 rounded-lg transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-sign-out-alt mr-2"></i>LOGOUT
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Favorites -->
                <div class="card p-6 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-600">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-white">FAVORITE BARBERS</h2>
                        <a href="{{ route('favorite.index') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">VIEW ALL</a>
                    </div>

                    @if(auth()->user()->favorites->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->favorites->take(3) as $favorite)
                                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-cut text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-sm text-white">{{ $favorite->barber->shop_name }}</h3>
                                        <p class="text-xs text-gray-300">{{ $favorite->barber->address }}</p>
                                    </div>
                                    <i class="fas fa-heart text-red-400"></i>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-heart-broken text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-300 text-sm">No favorites yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
