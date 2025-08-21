@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('search.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Search
            </a>
        </div>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Search Results</h1>
            <p class="text-gray-600 mt-2">
                Found {{ $barbers->count() }} barbers
                @if(request('location')) near "{{ request('location') }}" @endif
                @if(request('service')) offering "{{ request('service') }}" @endif
            </p>
        </div>
        <!-- Filters Summary -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-sm font-medium text-gray-700">Active filters:</span>
                @if(request('location'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ request('location') }}
                    </span>
                @endif
                @if(request('distance'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-ruler mr-1"></i> {{ request('distance') }} km
                    </span>
                @endif
                @if(request('service'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-cut mr-1"></i> {{ request('service') }}
                    </span>
                @endif
                @if(request('min_rating'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-star mr-1"></i> {{ request('min_rating') }}+ stars
                    </span>
                @endif
                @if(request('max_price'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-dollar-sign mr-1"></i> Under ${{ request('max_price') }}
                    </span>
                @endif
                <a href="{{ route('search.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                    Clear all filters
                </a>
            </div>
        </div>
        <!-- Results -->
        @if($barbers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($barbers as $barber)
                    <div class="bg-white rounded-xl shadow overflow-hidden card-hover">
                        <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                            @if($barber->profile_image)
                                <img src="{{ asset('storage/' . $barber->profile_image) }}" alt="{{ $barber->shop_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-cut text-white text-5xl opacity-50"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                @if(auth()->check())
                                    <button onclick="toggleFavorite({{ $barber->id }})" class="w-10 h-10 rounded-full bg-white bg-opacity-80 flex items-center justify-center hover:bg-opacity-100 transition">
                                        <i class="fas fa-heart {{ auth()->user()->favorites->contains('barber_id', $barber->id) ? 'text-red-500' : 'text-gray-400' }}"></i>
                                    </button>
                                @else
                                    <button onclick="alert('Please log in to add favorites')" class="w-10 h-10 rounded-full bg-white bg-opacity-80 flex items-center justify-center hover:bg-opacity-100 transition">
                                        <i class="fas fa-heart text-gray-400"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-900">{{ $barber->shop_name }}</h3>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($barber->average_rating ?? 0, 1) }}</span>
                                    <span class="text-sm text-gray-500 ml-1">({{ $barber->reviews_count ?? 0 }})</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $barber->description }}</p>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt w-5 text-center mr-2"></i>
                                    <span>{{ $barber->address }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-phone w-5 text-center mr-2"></i>
                                    <span>{{ $barber->phone }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-sm text-gray-500">Starting from</span>
                                    <p class="text-lg font-bold text-gray-900">${{ number_format($barber->min_price ?? 0, 2) }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('barber.profile', $barber->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('appointment.create', $barber->id) }}" class="btn-primary text-white px-4 py-2 rounded-full text-sm">
                                        Book
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-12 text-center">
                <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No barbers found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your search criteria or browse all barbers.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('search.index') }}" class="btn-primary text-white px-6 py-3 rounded-full">
                        <i class="fas fa-search mr-2"></i> New Search
                    </a>
                    <a href="{{ route('recommendation.top_rated') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-full border border-indigo-600 hover:bg-indigo-50">
                        <i class="fas fa-star mr-2"></i> Top Rated Barbers
                    </a>
                </div>
            </div>
        @endif
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
