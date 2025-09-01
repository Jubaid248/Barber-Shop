<?php
namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function create(Barber $barber)
    {
        // Check if this barber belongs to the current user
        if ($barber->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return view('photo.create', compact('barber'));
    }

    public function store(Request $request, Barber $barber)
    {
        // Check if this barber belongs to the current user
        if ($barber->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');

                Photo::create([
                    'barber_id' => $barber->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('barber.profile', $barber->id)->with('success', 'Photos uploaded successfully!');
    }

    public function updateProfileImage(Request $request, Barber $barber)
    {
        // Check if this barber belongs to the current user
        if ($barber->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($barber->profile_image) {
                Storage::disk('public')->delete($barber->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $barber->profile_image = $path;
            $barber->save();
        }

        return redirect()->route('barber.profile', $barber->id)->with('success', 'Profile image updated successfully!');
    }

    public function destroy(Photo $photo)
    {
        // Check if this photo belongs to the current user's barber
        if ($photo->barber->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Delete the file from storage
        Storage::disk('public')->delete($photo->image_path);

        // Delete the database record
        $photo->delete();

        return redirect()->route('barber.profile', $photo->barber_id)->with('success', 'Photo deleted successfully!');
    }
}
