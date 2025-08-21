@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="hero-content">
                <div class="inline-block px-4 py-2 bg-card border border-custom rounded-full mb-6">
                    <span class="text-accent text-sm font-semibold">PREMIUM BARBER SERVICES</span>
                </div>
                <h1 class="hero-title">
                    FIND YOUR<br>
                    <span class="text-accent">PERFECT</span> BARBER
                </h1>
                <p class="hero-subtitle">
                    Connect with elite barbers in your area. Book appointments with precision and style.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('search.index') }}" class="btn btn-primary">
                        <i class="fas fa-search mr-2"></i> FIND BARBERS
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        <i class="fas fa-plus mr-2"></i> JOIN AS BARBER
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1621605812565-5d5719e0a6d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Barber Shop" class="rounded-lg shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50 rounded-lg"></div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-card border border-custom rounded-lg p-4 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold">500+ BARBERS</div>
                            <div class="text-xs text-gray-400">AVAILABLE NOW</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section bg-card">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="section-title">CUTTING-EDGE FEATURES</h2>
            <p class="section-subtitle mx-auto">
                Experience the future of barber booking with our advanced platform
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">SMART SEARCH</h3>
                <p class="text-gray-400">
                    Find barbers near you with powerful filters for location, services, ratings, and price range
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">INSTANT BOOKING</h3>
                <p class="text-gray-400">
                    Book appointments in just a few clicks with real-time availability and instant confirmations
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">VERIFIED REVIEWS</h3>
                <p class="text-gray-400">
                    Read genuine reviews from real customers to make informed decisions about your next barber
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="section-title">HOW IT WORKS</h2>
            <p class="section-subtitle mx-auto">
                Get started with BarberFinder in three simple steps
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-card border-2 border-accent flex items-center justify-center text-2xl font-bold text-accent glow">
                    1
                </div>
                <h3 class="text-xl font-bold mb-3">DISCOVER</h3>
                <p class="text-gray-400">
                    Search for barbers in your area using our intuitive filters and find the perfect match
                </p>
                <a href="{{ route('search.index') }}" class="inline-flex items-center mt-4 text-accent font-semibold hover:text-accent-dark">
                    START SEARCHING <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-card border-2 border-accent flex items-center justify-center text-2xl font-bold text-accent glow">
                    2
                </div>
                <h3 class="text-xl font-bold mb-3">BOOK</h3>
                <p class="text-gray-400">
                    Select your preferred service, choose a convenient time slot, and book your appointment instantly
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center mt-4 text-accent font-semibold hover:text-accent-dark">
                    BOOK NOW <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-card border-2 border-accent flex items-center justify-center text-2xl font-bold text-accent glow">
                    3
                </div>
                <h3 class="text-xl font-bold mb-3">ENJOY</h3>
                <p class="text-gray-400">
                    Visit your barber, enjoy your service, and share your experience with the community
                </p>
                <a href="#" class="inline-flex items-center mt-4 text-accent font-semibold hover:text-accent-dark">
                    LEARN MORE <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section bg-card">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="section-title mb-6">READY TO TRANSFORM YOUR STYLE?</h2>
            <p class="section-subtitle mx-auto mb-10">
                Join thousands of satisfied customers who have found their ideal barber through our cutting-edge platform
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('search.index') }}" class="btn btn-primary">
                    <i class="fas fa-search mr-2"></i> FIND YOUR BARBER
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline">
                    <i class="fas fa-plus mr-2"></i> LIST YOUR BUSINESS
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
