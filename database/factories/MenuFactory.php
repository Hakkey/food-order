<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100), // Generate a random float number between 1 and 100 with 2 decimal places
            'image' => "71DDgpdMsDxEiyr3hH8ZKHvuosDyBKXTMDXmlQI8.png", // Generate a random image URL
            'category_id' => Category::inRandomOrder()->first()->id, // Get a random category id
            // Add other fields here...
        ];
    }
}
