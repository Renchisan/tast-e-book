<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('user', 'ratings')->latest()->get();

        return Inertia::render('Recipes/Index', [
            'recipes' => $recipes,
        ]);
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'ratings.user');
        return Inertia::render('Recipes/Show', [
            'recipe' => $recipe,
        ]);
    }

    public function create()
    {
        return Inertia::render('Recipes/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        $recipe = Auth::user()->recipes()->create($request->all());

        return redirect()->route('recipes.show', $recipe);
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        return Inertia::render('Recipes/Edit', [
            'recipe' => $recipe,
        ]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $recipe->update($request->all());

        return redirect()->route('recipes.show', $recipe);
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return redirect()->route('recipes.index');
    }
}
