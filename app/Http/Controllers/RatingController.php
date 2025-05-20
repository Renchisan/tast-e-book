<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request) {
    $request->validate([
        'recipe_id' => 'required|exists:recipes,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'nullable|string',
    ]);

    return Rating::create([
        'user_id' => auth()->id(),
        'recipe_id' => $request->recipe_id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);
}

}
