@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Edit Profile</h1>
            <p class="text-gray-300 text-lg">Update your profile information and settings</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Profile Information -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-600">
                <h2 class="text-2xl font-bold text-white mb-6">Profile Information</h2>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-600">
                <h2 class="text-2xl font-bold text-white mb-6">Update Password</h2>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-600">
                <h2 class="text-2xl font-bold text-white mb-6">Delete Account</h2>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
