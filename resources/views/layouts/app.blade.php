<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Barber Finder') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-primary: #000000;
            --bg-secondary: #0a0a0a;
            --bg-card: #141414;
            --bg-hover: #1a1a1a;
            --bg-input: #1f1f1f;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --text-muted: #808080;
            --accent: #00ff88; /* Razer green */
            --accent-dark: #00cc6a;
            --border-color: #2a2a2a;
            --input-border: #3a3a3a;
            --error: #ff4d4d;
            --shadow-glow: 0 0 20px rgba(0, 255, 136, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Navigation */
        .navbar {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            background-color: rgba(10, 10, 10, 0.95);
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--text-primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 2px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            font-family: 'Oswald', sans-serif;
        }

        .btn-primary {
            background-color: var(--accent);
            color: var(--bg-primary);
            box-shadow: var(--shadow-glow);
        }

        .btn-primary:hover {
            background-color: var(--accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 255, 136, 0.4);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-outline:hover {
            background-color: var(--bg-hover);
            border-color: var(--accent);
        }

        /* Cards */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
            box-shadow: var(--shadow-glow);
        }

        /* Sections */
        .section {
            padding: 80px 0;
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.25rem;
            margin-bottom: 3rem;
            max-width: 600px;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(0, 255, 136, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            max-width: 600px;
        }

        /* Feature Cards */
        .feature-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            border-color: var(--accent);
            transform: translateY(-10px);
        }

        .feature-card h3 {
            color: var(--text-primary) !important;
        }

        .feature-card p {
            color: var(--text-secondary) !important;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 2rem;
            color: var(--accent);
        }

        /* Animations */
        @keyframes glow {
            0% { box-shadow: 0 0 5px rgba(0, 255, 136, 0.5); }
            50% { box-shadow: 0 0 20px rgba(0, 255, 136, 0.8); }
            100% { box-shadow: 0 0 5px rgba(0, 255, 136, 0.5); }
        }

        .glow {
            animation: glow 2s infinite;
        }

        /* Footer */
        footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 60px 0 30px;
        }

        /* Form Styles - Fixed visibility issues */
        input, textarea, select {
            background-color: var(--bg-input) !important;
            border: 1px solid var(--input-border) !important;
            color: var(--text-primary) !important;
            padding: 12px 16px !important;
            border-radius: 2px !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
        }

        input:focus, textarea:focus, select:focus {
            outline: none !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 2px rgba(0, 255, 136, 0.2) !important;
        }

        input::placeholder, textarea::placeholder {
            color: var(--text-muted) !important;
        }

        label {
            display: block !important;
            margin-bottom: 8px !important;
            font-weight: 500 !important;
            text-transform: uppercase !important;
            font-size: 0.875rem !important;
            letter-spacing: 1px !important;
            color: var(--text-secondary) !important;
        }

        .form-group {
            margin-bottom: 20px !important;
        }

        .btn-form {
            background-color: var(--accent) !important;
            color: var(--bg-primary) !important;
            padding: 12px 24px !important;
            border: none !important;
            border-radius: 2px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.875rem !important;
            letter-spacing: 1px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            font-family: 'Oswald', sans-serif !important;
            width: 100% !important;
        }

        .btn-form:hover {
            background-color: var(--accent-dark) !important;
        }

        /* Form Checkbox */
        .form-checkbox {
            appearance: none !important;
            width: 20px !important;
            height: 20px !important;
            border: 1px solid var(--input-border) !important;
            border-radius: 2px !important;
            background-color: var(--bg-input) !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            cursor: pointer !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        .form-checkbox:checked {
            background-color: var(--accent) !important;
            border-color: var(--accent) !important;
        }

        .form-checkbox:checked::after {
            content: '\f00c' !important;
            font-family: 'Font Awesome 5 Free' !important;
            font-weight: 900 !important;
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            color: var(--bg-primary) !important;
            font-size: 12px !important;
        }

        /* Card adjustments */
        .card {
            margin-top: 20px;
        }

        /* Adjust main content to not be hidden under fixed navbar */
        main {
            padding-top: 80px;
        }

        /* Specific adjustments for form pages */
        .form-page {
            padding-top: 100px;
            min-height: 100vh;
        }

        /* Quick Actions Card Fix */
        .quick-action-card {
            background-color: var(--bg-card) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 2px !important;
            padding: 1.5rem !important;
            text-align: center !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
        }

        .quick-action-card:hover {
            border-color: var(--accent) !important;
            transform: translateY(-5px) !important;
        }

        .quick-action-card i {
            color: var(--accent) !important;
            font-size: 2rem !important;
            margin-bottom: 0.75rem !important;
        }

        .quick-action-card p {
            color: var(--text-primary) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.875rem !important;
            letter-spacing: 1px !important;
        }

        /* Error messages */
        .error-message {
            color: var(--error) !important;
            font-size: 0.875rem !important;
            margin-top: 0.25rem !important;
        }

        /* Utility Classes */
        .text-accent {
            color: var(--accent) !important;
        }

        .bg-card {
            background-color: var(--bg-card) !important;
        }

        .border-custom {
            border-color: var(--border-color) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center glow">
                        <i class="fas fa-cut text-white"></i>
                    </div>
                    <span class="text-2xl font-bold text-accent">BARBER<span class="text-white">FINDER</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                    <a href="{{ route('search.index') }}" class="nav-link">Find Barbers</a>
                    <a href="#" class="nav-link">Services</a>
                    <a href="#" class="nav-link">About</a>

                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="relative">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <span class="text-white">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-card border border-custom rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Dashboard</a>
                                @if(auth()->user()->barber)
                                    <a href="{{ route('barber.dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Barber Dashboard</a>
                                @else
                                    <a href="{{ route('barber.create') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Become a Barber</a>
                                @endif
                                <a href="{{ route('appointment.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">My Appointments</a>
                                <a href="{{ route('favorite.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Favorites</a>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-800">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <div class="md:hidden flex items-center">
                    <button onclick="toggleMobileMenu()" class="text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-card border-t border-custom">
            <div class="container mx-auto px-4 py-4 space-y-2">
                <a href="{{ url('/') }}" class="block py-2 text-white">Home</a>
                <a href="{{ route('search.index') }}" class="block py-2 text-white">Find Barbers</a>
                <a href="#" class="block py-2 text-white">Services</a>
                <a href="#" class="block py-2 text-white">About</a>

                @guest
                    <a href="{{ route('login') }}" class="block py-2 text-white">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 text-white">Sign Up</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block py-2 text-white">Dashboard</a>
                    @if(auth()->user()->barber)
                        <a href="{{ route('barber.dashboard') }}" class="block py-2 text-white">Barber Dashboard</a>
                    @else
                        <a href="{{ route('barber.create') }}" class="block py-2 text-white">Become a Barber</a>
                    @endif
                    <a href="{{ route('appointment.index') }}" class="block py-2 text-white">My Appointments</a>
                    <a href="{{ route('favorite.index') }}" class="block py-2 text-white">Favorites</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-white">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                            <i class="fas fa-cut text-white"></i>
                        </div>
                        <span class="text-2xl font-bold text-accent">BARBER<span class="text-white">FINDER</span></span>
                    </div>
                    <p class="text-gray-400">Find the perfect barber near you with our cutting-edge platform.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-uppercase">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="{{ route('search.index') }}" class="text-gray-400 hover:text-white">Find Barbers</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Sign Up</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Login</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-uppercase">For Barbers</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('barber.create') }}" class="text-gray-400 hover:text-white">Join Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">How It Works</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Support</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-uppercase">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
                    </div>
                </div>
            </div>

            <div class="border-t border-custom pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} BarberFinder. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const userMenuButton = event.target.closest('button[onclick="toggleUserMenu()"]');

            if (!userMenuButton && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
