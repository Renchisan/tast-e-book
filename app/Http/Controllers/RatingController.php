<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $rating = Rating::create([
            'user_id' => Auth::id(),
            'recipe_id' => $request->recipe_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back();
    }
}
