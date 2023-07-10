<?php

namespace Database\Factories;

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
        $name = fake()->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence,
            'price' => fake()->randomFloat(2, 10, 100),
            'quantity' => fake()->randomNumber(2),
            'is_available' => fake()->boolean,
            'release_date' => fake()->date(),
            'status' => fake()->randomElement(['updated', 'new', 'expired']),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'store_id' => function () {
                return Store::inRandomOrder()->first()->id;
            },
            'image' => fake()->imageUrl(),
        ];
    }
}
