<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php?s=');

        if ($response->successful() && isset($response['meals'])) {
            foreach ($response['meals'] as $meal) {
                Recipe::create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'title' => $meal['strMeal'],
                    'description' => $meal['strInstructions'],
                    'ingredients' => fake()->paragraph(2),
                    'instructions' => $meal['strInstructions'],
                    'image' => $meal['strMealThumb'],
                ]);
                
            }
        }
    }
}
