<?php

namespace Database\Factories\Store;

use App\Models\Store\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $category = Category::inRandomOrder()->first();

        return [
            'name' =>$name ,
            'description'=> fake()->paragraph(),
            'parent_id' => $category ? $category->id : null,
            'status'=> fake()->randomElement(['active', 'archive'])

        ];
    }
}
