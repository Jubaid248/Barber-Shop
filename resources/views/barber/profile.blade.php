@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('search.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Search
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Barber Header -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="h-64 bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                        @if($barber->profile_image)
                            <img src="{{ asset('storage/' . $barber->profile_image) }}" alt="{{ $barber->shop_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-cut text-white text-6xl opacity-50"></i>
                            </div>
                        @endif

                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <div class="flex justify-between items-end">
                                <div>
                                    <h1 class="text-3xl font-bold text-white">{{ $barber->shop_name }}</h1>
                                    <div class="flex items-center mt-2">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($barber->average_rating))
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                @elseif($i - 0.5 <= $barber->average_rating)
                                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                                @else
                                                    <i class="far fa-star text-yellow-400"></i>
                                                @endif
                                            @endfor
                                            <span class="ml-2 text-white">{{ number_format($barber->average_rating, 1) }}</span>
                                            <span class="text-white text-opacity-70 ml-1">({{ $barber->reviews_count }} reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if(auth()->check() && !auth()->user()->barber)
                                        <button onclick="toggleFavorite({{ $barber->id }})" class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                                            <i class="fas fa-heart text-white text-xl {{ auth()->user()->favorites->contains('barber_id', $barber->id) ? 'text-red-500' : '' }}"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-indigo-600 mt-1 mr-3 w-5"></i>
                                        <span class="text-gray-600">{{ $barber->address }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-indigo-600 mr-3 w-5"></i>
                                        <span class="text-gray-600">{{ $barber->phone }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope text-indigo-600 mr-3 w-5"></i>
                                        <span class="text-gray-600">{{ $barber->user->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Business Hours</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Monday - Friday</span>
                                        <span class="text-gray-900">9:00 AM - 7:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Saturday</span>
                                        <span class="text-gray-900">9:00 AM - 5:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Sunday</span>
                                        <span class="text-gray-900">Closed</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">About</h3>
                            <p class="text-gray-600">{{ $barber->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery -->
                @if($barber->photos->count() > 0)
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Photo Gallery</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($barber->photos as $photo)
                                    <div class="aspect-square rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Barber Shop Photo" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Reviews -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900">Customer Reviews</h2>
                            @if(auth()->check() && !auth()->user()->barber)
                                <a href="{{ route('review.create', $barber->id) }}" class="btn-primary text-white px-4 py-2 rounded-full text-sm">
                                    <i class="fas fa-plus mr-2"></i> Add Review
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @if($barber->reviews->count() > 0)
                            @foreach($barber->reviews as $review)
                                <div class="p-6">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <i class="fas fa-user text-indigo-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $review->user->name }}</h4>
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                                        @else
                                                            <i class="far fa-star text-yellow-400 text-sm"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">{{ $review->created_at->format('F j, Y') }}</p>
                                            <p class="mt-3 text-sm text-gray-600">{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-12 text-center">
                                <i class="fas fa-star text-gray-400 text-5xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No reviews yet</h3>
                                <p class="text-gray-500 mb-6">Be the first to review this barber.</p>
                                @if(auth()->check() && !auth()->user()->barber)
                                    <a href="{{ route('review.create', $barber->id) }}" class="btn-primary text-white px-6 py-3 rounded-full">
                                        <i class="fas fa-plus mr-2"></i> Add Review
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Book Appointment -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-500 to-emerald-600">
                        <h2 class="text-lg font-bold text-white">Book Appointment</h2>
                    </div>

                    <div class="p-6">
                        @if(auth()->check())
                            @if(!auth()->user()->barber)
                                <a href="{{ route('appointment.create', $barber->id) }}" class="w-full btn-primary text-white px-4 py-3 rounded-full text-center block">
                                    <i class="fas fa-calendar-plus mr-2"></i> Book Now
                                </a>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-exclamation-circle text-yellow-500 text-3xl mb-2"></i>
                                    <p class="text-sm text-gray-600">You cannot book appointments as a barber</p>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-600 mb-4">Please login to book an appointment</p>
                                <a href="{{ route('login') }}" class="btn-primary text-white px-4 py-3 rounded-full">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Services -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Services & Prices</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Haircut</span>
                                <span class="font-medium text-gray-900">$25.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Beard Trim</span>
                                <span class="font-medium text-gray-900">$15.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Shave</span>
                                <span class="font-medium text-gray-900">$20.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Hair Coloring</span>
                                <span class="font-medium text-gray-900">$50.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Availability</h2>
                    </div>

                    <div class="p-6">
                        @if($barber->availabilities->count() > 0)
                            <div class="space-y-3">
                                @foreach($barber->availabilities->take(3) as $availability)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">{{ $availability->day }}</span>
                                        <span class="text-sm text-gray-900">{{ $availability->start_time }} - {{ $availability->end_time }}</span>
                                    </div>
                                @endforeach
                                @if($barber->availabilities->count() > 3)
                                    <div class="text-center mt-2">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">View all availability</a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No availability information provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Contact</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="tel:{{ $barber->phone }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                <i class="fas fa-phone mr-3 text-indigo-600"></i>
                                Call Now
                            </a>

                            @if(auth()->check())
                                <a href="{{ route('message.show', $barber->user_id) }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-comment mr-3 text-indigo-600"></i>
                                    Send Message
                                </a>
                            @endif

                            <a href="https://maps.google.com/?q={{ $barber->latitude }},{{ $barber->longitude }}" target="_blank" class="flex items-center text-gray-600 hover:text-gray-900">
                                <i class="fas fa-map-marker-alt mr-3 text-indigo-600"></i>
                                Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFavorite(barberId) {
    fetch(`/favorite/${barberId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
