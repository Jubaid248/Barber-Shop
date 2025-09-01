@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                About BarberFinder
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Connecting customers with the best barbers in their area through our innovative platform
            </p>
        </div>

        <!-- Mission Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <div>
                <h2 class="text-3xl font-bold text-white mb-6">Our Mission</h2>
                <p class="text-gray-300 text-lg leading-relaxed mb-6">
                    We believe everyone deserves access to quality barber services. Our platform makes it easy to find, book, and review barbers in your local area.
                </p>
                <p class="text-gray-300 text-lg leading-relaxed">
                    Whether you're looking for a classic cut, modern style, or specialized service, BarberFinder connects you with skilled professionals who can deliver exactly what you need.
                </p>
            </div>
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-8 text-center">
                <i class="fas fa-cut text-white text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-white mb-2">Quality Service</h3>
                <p class="text-indigo-100">Every barber on our platform is vetted for quality and customer satisfaction</p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Why Choose BarberFinder?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-6 border border-gray-600 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Easy Discovery</h3>
                    <p class="text-gray-300">Find barbers near you with powerful filters for location, services, and ratings</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-6 border border-gray-600 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Simple Booking</h3>
                    <p class="text-gray-300">Book appointments instantly with our streamlined booking system</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-6 border border-gray-600 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Trusted Reviews</h3>
                    <p class="text-gray-300">Read genuine reviews from real customers to make informed decisions</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-600 mb-20">
            <h2 class="text-3xl font-bold text-white text-center mb-8">Our Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-indigo-400 mb-2">1000+</div>
                    <div class="text-gray-300">Happy Customers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-400 mb-2">500+</div>
                    <div class="text-gray-300">Professional Barbers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-yellow-400 mb-2">2000+</div>
                    <div class="text-gray-300">Appointments Booked</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-400 mb-2">4.8</div>
                    <div class="text-gray-300">Average Rating</div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Get in Touch</h2>
            <p class="text-gray-300 text-lg mb-8">
                Have questions or suggestions? We'd love to hear from you!
            </p>
            <div class="flex justify-center space-x-6">
                <a href="mailto:contact@barberfinder.com" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-8 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-envelope mr-2"></i>Email Us
                </a>
                <a href="{{ route('search.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-3 rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-search mr-2"></i>Find Barbers
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
