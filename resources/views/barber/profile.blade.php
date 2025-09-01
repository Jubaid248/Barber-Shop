@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('search.index') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Search
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Barber Header -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="h-64 bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                        @if($barber->profile_image)
                            <img src="{{ asset('storage/' . $barber->profile_image) }}" alt="{{ $barber->shop_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-cut text-white text-6xl opacity-50"></i>
                            </div>
                        @endif

                        <!-- Profile Image Upload Button (for barber owner) -->
                        @if(auth()->check() && auth()->user()->id == $barber->user_id)
                            <div class="absolute top-4 right-4">
                                <button type="button" class="w-10 h-10 rounded-full bg-white bg-opacity-80 flex items-center justify-center hover:bg-opacity-100 transition" data-bs-toggle="modal" data-bs-target="#profileImageModal">
                                    <i class="fas fa-camera text-indigo-600"></i>
                                </button>
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
                                <h3 class="text-lg font-medium text-white mb-4">Contact Information</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-indigo-400 mt-1 mr-3 w-5"></i>
                                        <span class="text-gray-300">{{ $barber->address }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-indigo-400 mr-3 w-5"></i>
                                        <span class="text-gray-300">{{ $barber->phone }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope text-indigo-400 mr-3 w-5"></i>
                                        <span class="text-gray-300">{{ $barber->user->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-white mb-4">Business Hours</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Monday - Friday</span>
                                        <span class="text-white font-medium">9:00 AM - 7:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Saturday</span>
                                        <span class="text-white font-medium">9:00 AM - 5:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Sunday</span>
                                        <span class="text-white font-medium">Closed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-white mb-2">About</h3>
                            <p class="text-gray-300">{{ $barber->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-white">Photo Gallery</h2>
                        @if(auth()->check() && auth()->user()->id == $barber->user_id)
                            <a href="{{ route('photo.create', $barber->id) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-4 py-2 rounded-full text-sm transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-plus mr-2"></i> Add Photos
                            </a>
                        @endif
                    </div>
                    <div class="p-6">
                        @if($barber->photos->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($barber->photos as $photo)
                                    <div class="relative group">
                                        <div class="aspect-square rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Barber Shop Photo" class="w-full h-full object-cover">
                                        </div>
                                        @if(auth()->check() && auth()->user()->id == $barber->user_id)
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                                <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="fas fa-images text-gray-400 text-5xl mb-4"></i>
                                <h3 class="text-lg font-medium text-white mb-2">No photos yet</h3>
                                <p class="text-gray-300 mb-6">This barber hasn't added any photos to their gallery yet.</p>
                                @if(auth()->check() && auth()->user()->id == $barber->user_id)
                                    <a href="{{ route('photo.create', $barber->id) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <i class="fas fa-plus mr-2"></i> Add Photos
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-medium text-white">Customer Reviews</h2>
                            @if(auth()->check() && !auth()->user()->barber)
                                <a href="{{ route('review.create', $barber->id) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-4 py-2 rounded-full text-sm transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-plus mr-2"></i> Add Review
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="divide-y divide-gray-600">
                        @if($barber->reviews->count() > 0)
                            @foreach($barber->reviews as $review)
                                <div class="p-6 hover:bg-gray-700 transition-colors duration-200">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-sm font-medium text-white">{{ $review->user->name }}</h4>
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
                                            <p class="text-sm text-gray-300 mt-1">{{ $review->created_at->format('F j, Y') }}</p>
                                            <p class="mt-3 text-sm text-gray-200">{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-12 text-center">
                                <i class="fas fa-star text-gray-400 text-5xl mb-4"></i>
                                <h3 class="text-lg font-medium text-white mb-2">No reviews yet</h3>
                                <p class="text-gray-300 mb-6">Be the first to review this barber.</p>
                                @if(auth()->check() && !auth()->user()->barber)
                                    <a href="{{ route('review.create', $barber->id) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
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
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-green-500 to-emerald-600">
                        <h2 class="text-lg font-bold text-white">Book Appointment</h2>
                    </div>
                    <div class="p-6">
                        @if(auth()->check())
                            @if(!auth()->user()->barber)
                                <a href="{{ route('appointment.create', $barber->id) }}" class="w-full bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-4 py-3 rounded-full text-center block transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-calendar-plus mr-2"></i> Book Now
                                </a>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-exclamation-circle text-yellow-400 text-3xl mb-2"></i>
                                    <p class="text-sm text-gray-300">You cannot book appointments as a barber</p>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-300 mb-4">Please login to book an appointment</p>
                                <a href="{{ route('login') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-4 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Services -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800">
                        <h2 class="text-lg font-medium text-white">Services & Prices</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-600">
                                <span class="text-gray-300">Haircut</span>
                                <span class="font-medium text-white">$25.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-600">
                                <span class="text-gray-300">Beard Trim</span>
                                <span class="font-medium text-white">$15.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-600">
                                <span class="text-gray-300">Shave</span>
                                <span class="font-medium text-white">$20.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-300">Hair Coloring</span>
                                <span class="font-medium text-white">$50.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Availability -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800">
                        <h2 class="text-lg font-medium text-white">Availability</h2>
                    </div>
                    <div class="p-6">
                        @if($barber->availabilities->count() > 0)
                            <div class="space-y-3">
                                @foreach($barber->availabilities->take(3) as $availability)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">{{ $availability->day }}</span>
                                        <span class="text-sm text-white font-medium">{{ $availability->start_time }} - {{ $availability->end_time }}</span>
                                    </div>
                                @endforeach
                                @if($barber->availabilities->count() > 3)
                                    <div class="text-center mt-2">
                                        <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm transition-colors">View all availability</a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-300 text-sm">No availability information provided.</p>
                        @endif
                    </div>
                </div>
                <!-- Contact -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-600">
                    <div class="px-6 py-4 border-b border-gray-600 bg-gradient-to-r from-gray-700 to-gray-800">
                        <h2 class="text-lg font-medium text-white">Contact</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="tel:{{ $barber->phone }}" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <i class="fas fa-phone mr-3 text-indigo-400"></i>
                                Call Now
                            </a>
                            @if(auth()->check())
                                <a href="{{ route('message.show', $barber->user_id) }}" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                    <i class="fas fa-comment mr-3 text-indigo-400"></i>
                                    Send Message
                                </a>
                            @endif
                            <a href="https://maps.google.com/?q={{ $barber->latitude }},{{ $barber->longitude }}" target="_blank" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <i class="fas fa-map-marker-alt mr-3 text-indigo-400"></i>
                                Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Image Upload Modal -->
<div class="modal fade" id="profileImageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('photo.update.profile', $barber->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Image</button>
                    </div>
                </form>
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
