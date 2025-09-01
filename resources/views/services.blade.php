@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Our Services
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Discover the wide range of professional barber services available through our platform
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            <!-- Haircut Services -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-indigo-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cut text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Haircuts</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Classic Cuts
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Modern Styles
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Fade & Taper
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Kids Cuts
                    </li>
                </ul>
            </div>

            <!-- Beard Services -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-green-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-tie text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Beard Grooming</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Beard Trim
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Beard Shaping
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Hot Towel Service
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Beard Oil Treatment
                    </li>
                </ul>
            </div>

            <!-- Styling Services -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-purple-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-magic text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Styling</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Hair Styling
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Product Application
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Hair Treatments
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Consultation
                    </li>
                </ul>
            </div>

            <!-- Special Services -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-yellow-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Special Services</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Head Shave
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Face Shave
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Eyebrow Grooming
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Ear & Nose Hair
                    </li>
                </ul>
            </div>

            <!-- Package Deals -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-red-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-gift text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Package Deals</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Haircut + Beard
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Full Grooming
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Family Packages
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Student Discounts
                    </li>
                </ul>
            </div>

            <!-- Premium Services -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-600 hover:border-indigo-500 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-crown text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 text-center">Premium Services</h3>
                <ul class="text-gray-300 space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        VIP Treatment
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Private Sessions
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Luxury Products
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-400 mr-2"></i>
                        Extended Hours
                    </li>
                </ul>
            </div>
        </div>

        <!-- Pricing Section -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-600 mb-20">
            <h2 class="text-3xl font-bold text-white text-center mb-8">Typical Pricing</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                <div class="bg-gray-700 rounded-xl p-4">
                    <h3 class="text-lg font-bold text-white mb-2">Basic Cut</h3>
                    <div class="text-2xl font-bold text-indigo-400 mb-2">$15-25</div>
                    <p class="text-gray-300 text-sm">Standard haircut service</p>
                </div>
                <div class="bg-gray-700 rounded-xl p-4">
                    <h3 class="text-lg font-bold text-white mb-2">Beard Trim</h3>
                    <div class="text-2xl font-bold text-green-400 mb-2">$10-20</div>
                    <p class="text-gray-300 text-sm">Beard grooming & shaping</p>
                </div>
                <div class="bg-gray-700 rounded-xl p-4">
                    <h3 class="text-lg font-bold text-white mb-2">Full Service</h3>
                    <div class="text-2xl font-bold text-purple-400 mb-2">$25-40</div>
                    <p class="text-gray-300 text-sm">Haircut + beard + styling</p>
                </div>
                <div class="bg-gray-700 rounded-xl p-4">
                    <h3 class="text-lg font-bold text-white mb-2">Premium</h3>
                    <div class="text-2xl font-bold text-yellow-400 mb-2">$40-60</div>
                    <p class="text-gray-300 text-sm">VIP treatment & products</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-gray-300 text-lg mb-8">
                Find a barber near you and book your appointment today!
            </p>
            <div class="flex justify-center space-x-6">
                <a href="{{ route('search.index') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-8 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-search mr-2"></i>Find Barbers
                </a>
                <a href="{{ route('about') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-info-circle mr-2"></i>Learn More
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
