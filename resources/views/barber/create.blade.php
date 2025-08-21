@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="card p-8">
                <h1 class="text-3xl font-bold mb-2">CREATE BARBER PROFILE</h1>
                <p class="text-gray-400 mb-8">Set up your barber shop profile to start receiving appointments</p>

                <form method="POST" action="{{ route('barber.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="shop_name">SHOP NAME</label>
                        <input type="text" id="shop_name" name="shop_name" class="form-control" value="{{ old('shop_name') }}" required autofocus>
                        @error('shop_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">DESCRIPTION</label>
                        <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">ADDRESS</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">PHONE</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="latitude">LATITUDE</label>
                            <input type="text" id="latitude" name="latitude" class="form-control" value="{{ old('latitude') }}" step="any">
                            @error('latitude')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="longitude">LONGITUDE</label>
                            <input type="text" id="longitude" name="longitude" class="form-control" value="{{ old('longitude') }}" step="any">
                            @error('longitude')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="btn-form w-full">
                            CREATE PROFILE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
