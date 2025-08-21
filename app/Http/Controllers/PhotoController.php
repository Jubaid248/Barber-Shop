<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(Barber $barber)
    {
        // Only allow the barber owner to add photos
        if (auth()->id() !== $barber->user_id) {
            abort(403);
        }

        return view('photo.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        // Only allow the barber owner to add photos
        if (auth()->id() !== $barber->user_id) {
            abort(403);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('barber_photos', 'public');

        Photo::create([
            'barber_id' => $barber->id,
            'image_path' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('barber.profile', $barber)->with('success', 'Photo added successfully!');
    }

    public function updateProfileImage(Request $request, Barber $barber)
    {
        // Only allow the barber owner to update profile image
        if (auth()->id() !== $barber->user_id) {
            abort(403);
        }

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old profile image if exists
        if ($barber->profile_image) {
            \Storage::disk('public')->delete($barber->profile_image);
        }

        $imagePath = $request->file('profile_image')->store('barber_profiles', 'public');

        $barber->update([
            'profile_image' => $imagePath,
        ]);

        return redirect()->route('barber.profile', $barber)->with('success', 'Profile image updated successfully!');
    }
}
