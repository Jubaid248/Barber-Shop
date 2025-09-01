@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Photo for {{ $barber->shop_name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('photo.store', $barber->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Select Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                            @error('image')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                            <div class="form-text">Allowed file types: jpeg, png, jpg, gif. Max size: 2MB.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_profile" name="is_profile" value="1">
                            <label class="form-check-label" for="is_profile">
                                Set as profile image
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Upload Photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
