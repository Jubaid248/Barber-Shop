@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card p-8">
                <h1 class="text-3xl font-bold mb-2">LOGIN</h1>
                <p class="text-gray-400 mb-8">Sign in to your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-4 mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox">
                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-accent hover:text-accent-dark" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn-form w-full">
                            LOGIN
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-400">Don't have an account?
                        <a href="{{ route('register') }}" class="text-accent hover:text-accent-dark">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
