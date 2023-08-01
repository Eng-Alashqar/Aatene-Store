<?php

namespace Database\Factories\Store;

use App\Models\Admin\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();
        return [
            'name' => $name,
            'description' => fake()->sentence,
            'price' => fake()->randomFloat(2, 10, 100),
            'quantity' => fake()->randomNumber(2),
            'is_available' => fake()->boolean,
            'featured' => fake()->boolean,
            // 'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'category_id' =>  Category::inRandomOrder()->first()->id,
            'store_id' =>  Store::inRandomOrder()->first()->id,
        ];
    }
}
