@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">DASHBOARD</h1>
            <p class="text-gray-400">Welcome back, {{ auth()->user()->name }}</p>
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
                <div class="card p-6">
                    <h2 class="text-xl font-bold mb-4">QUICK ACTIONS</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @if(!auth()->user()->barber)
                            <a href="{{ route('barber.create') }}" class="quick-action-card">
                                <i class="fas fa-plus-circle"></i>
                                <p>CREATE BARBER PROFILE</p>
                            </a>
                        @endif

                        <a href="{{ route('search.index') }}" class="quick-action-card">
                            <i class="fas fa-search"></i>
                            <p>FIND BARBERS</p>
                        </a>

                        <a href="{{ route('appointment.index') }}" class="quick-action-card">
                            <i class="fas fa-calendar-alt"></i>
                            <p>MY APPOINTMENTS</p>
                        </a>

                        <a href="{{ route('favorite.index') }}" class="quick-action-card">
                            <i class="fas fa-heart"></i>
                            <p>MY FAVORITES</p>
                        </a>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <div class="card p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">RECENT APPOINTMENTS</h2>
                        <a href="{{ route('appointment.index') }}" class="text-accent hover:text-accent-dark">VIEW ALL</a>
                    </div>

                    @if(auth()->user()->appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach(auth()->user()->appointments->take(3) as $appointment)
                                <div class="border-b border-custom pb-4 last:border-0 last:pb-0">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-semibold">{{ $appointment->barber->shop_name }}</h3>
                                            <p class="text-sm text-gray-400">{{ $appointment->appointment_time->format('M j, Y g:i A') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $appointment->status == 'confirmed' ? 'bg-green-900 text-green-400' : ($appointment->status == 'pending' ? 'bg-yellow-900 text-yellow-400' : ($appointment->status == 'cancelled' ? 'bg-red-900 text-red-400' : 'bg-blue-900 text-blue-400')) }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            <p class="text-sm text-gray-400 mt-1">${{ number_format($appointment->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-600 text-4xl mb-3"></i>
                            <p class="text-gray-400">You don't have any appointments yet.</p>
                            <a href="{{ route('search.index') }}" class="btn btn-primary mt-4">FIND BARBERS</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- User Profile Card -->
                <div class="card p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="font-bold">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    @if(auth()->user()->barber)
                        <div class="bg-card border border-accent rounded-lg p-4 mb-4">
                            <p class="text-sm text-accent font-semibold">YOU'RE A BARBER!</p>
                            <a href="{{ route('barber.dashboard') }}" class="text-accent text-sm hover:text-accent-dark">GO TO BARBER DASHBOARD →</a>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <button class="w-full bg-card border border-custom hover:border-accent text-white py-2 px-4 rounded-lg transition font-semibold">
                            EDIT PROFILE
                        </button>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full bg-card border border-red-600 hover:bg-red-900 text-red-600 py-2 px-4 rounded-lg transition font-semibold">
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Favorites -->
                <div class="card p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">FAVORITE BARBERS</h2>
                        <a href="{{ route('favorite.index') }}" class="text-accent hover:text-accent-dark">VIEW ALL</a>
                    </div>

                    @if(auth()->user()->favorites->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->favorites->take(3) as $favorite)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                        <i class="fas fa-cut text-accent"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-sm">{{ $favorite->barber->shop_name }}</h3>
                                        <p class="text-xs text-gray-400">{{ $favorite->barber->address }}</p>
                                    </div>
                                    <i class="fas fa-heart text-red-500"></i>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-heart-broken text-gray-600 text-2xl mb-2"></i>
                            <p class="text-gray-400 text-sm">No favorites yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
