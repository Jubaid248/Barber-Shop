@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card p-8">
                <h1 class="text-3xl font-bold mb-2">REGISTER</h1>
                <p class="text-gray-400 mb-8">Create a new account</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">NAME</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
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

                    <div class="form-group">
                        <label for="password_confirmation">CONFIRM PASSWORD</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn-form w-full">
                            REGISTER
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-400">Already have an account?
                        <a href="{{ route('login') }}" class="text-accent hover:text-accent-dark">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
