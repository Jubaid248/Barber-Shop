@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="card p-8">
                <h1 class="text-3xl font-bold mb-2">BOOK APPOINTMENT</h1>
                <p class="text-gray-400 mb-8">Schedule an appointment with {{ $barber->shop_name }}</p>

                <form method="POST" action="{{ route('appointment.store', $barber) }}">
                    @csrf

                    <div class="form-group">
                        <label for="service">SERVICE</label>
                        <select id="service" name="service" class="form-control" required>
                            <option value="">Select a service</option>
                            <option value="Haircut" {{ old('service') == 'Haircut' ? 'selected' : '' }}>Haircut</option>
                            <option value="Beard Trim" {{ old('service') == 'Beard Trim' ? 'selected' : '' }}>Beard Trim</option>
                            <option value="Shave" {{ old('service') == 'Shave' ? 'selected' : '' }}>Shave</option>
                            <option value="Hair Coloring" {{ old('service') == 'Hair Coloring' ? 'selected' : '' }}>Hair Coloring</option>
                            <option value="Styling" {{ old('service') == 'Styling' ? 'selected' : '' }}>Styling</option>
                        </select>
                        @error('service')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="appointment_time">DATE & TIME</label>
                        <input type="datetime-local" id="appointment_time" name="appointment_time" class="form-control" required>
                        @error('appointment_time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">PRICE ($)</label>
                        <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">NOTES (OPTIONAL)</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="btn-form w-full">
                            BOOK APPOINTMENT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
