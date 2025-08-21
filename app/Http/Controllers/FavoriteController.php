<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favoriteBarbers()->with('user')->get();

        return view('favorite.index', compact('favorites'));
    }

    public function store(Barber $barber)
    {
        // Check if already favorited
        if (auth()->user()->favorites()->where('barber_id', $barber->id)->exists()) {
            return back()->with('error', 'Barber is already in your favorites!');
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'barber_id' => $barber->id,
        ]);

        return back()->with('success', 'Barber added to favorites!');
    }

    public function destroy(Barber $barber)
    {
        auth()->user()->favorites()->where('barber_id', $barber->id)->delete();

        return back()->with('success', 'Barber removed from favorites!');
    }
}
