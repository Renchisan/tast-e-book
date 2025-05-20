<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index() {
        return Recipe::with('user', 'ratings')->latest()->get();
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        return auth()->user()->recipes()->create($request->all());
    }

    public function update(Request $request, Recipe $recipe) {
        $this->authorize('update', $recipe);
        $recipe->update($request->all());
        return $recipe;
    }

    public function destroy(Recipe $recipe) {
        $this->authorize('delete', $recipe);
        $recipe->delete();
        return response()->noContent();
    }

}
