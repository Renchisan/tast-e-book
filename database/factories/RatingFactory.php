<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $recipe = Recipe::inRandomOrder()->first();
        $user = User::where('id', '!=', $recipe->user_id)->inRandomOrder()->first();

        return [
            'user_id' => $user->id ?? User::factory(), // fallback
            'recipe_id' => $recipe->id,
            'rating' => fake()->numberBetween(1, 5),
            'review' => fake()->sentence(),
        ];
    }
}
