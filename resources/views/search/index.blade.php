@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Find Your Perfect Barber</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Search for barbers in your area and book appointments with ease</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <form method="GET" action="{{ route('search.results') }}">
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="location" name="location" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter city, postal code, or address" value="{{ old('location') }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="distance" class="block text-sm font-medium text-gray-700 mb-2">Search Radius</label>
                            <select id="distance" name="distance" class="block w-full py-3 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="5">5 km</option>
                                <option value="10">10 km</option>
                                <option value="25" selected>25 km</option>
                                <option value="50">50 km</option>
                                <option value="100">100 km</option>
                            </select>
                        </div>

                        <div>
                            <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                            <select id="service" name="service" class="block w-full py-3 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Services</option>
                                <option value="haircut">Haircut</option>
                                <option value="beard trim">Beard Trim</option>
                                <option value="shave">Shave</option>
                                <option value="coloring">Coloring</option>
                                <option value="styling">Styling</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="min_rating" class="block text-sm font-medium text-gray-700 mb-2">Minimum Rating</label>
                            <select id="min_rating" name="min_rating" class="block w-full py-3 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Any Rating</option>
                                <option value="4">4+ Stars</option>
                                <option value="3">3+ Stars</option>
                                <option value="2">2+ Stars</option>
                            </select>
                        </div>

                        <div>
                            <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">Maximum Price</label>
                            <select id="max_price" name="max_price" class="block w-full py-3 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Any Price</option>
                                <option value="25">$25 or less</option>
                                <option value="50">$50 or less</option>
                                <option value="75">$75 or less</option>
                                <option value="100">$100 or less</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-medium">
                        <i class="fas fa-search mr-2"></i> Search Barbers
                    </button>
                </form>
            </div>

            <!-- Popular Searches -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Popular Searches</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('search.results', ['location' => 'New York']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-map-marker-alt mr-1"></i> New York
                    </a>
                    <a href="{{ route('search.results', ['location' => 'Los Angeles']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-map-marker-alt mr-1"></i> Los Angeles
                    </a>
                    <a href="{{ route('search.results', ['service' => 'haircut']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-cut mr-1"></i> Haircut
                    </a>
                    <a href="{{ route('search.results', ['service' => 'beard trim']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-cut mr-1"></i> Beard Trim
                    </a>
                    <a href="{{ route('recommendation.top_rated') }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-star mr-1"></i> Top Rated
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
