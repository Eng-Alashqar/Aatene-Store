<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Category>
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
            'slug' =>Str::slug($name),
            'description'=> fake()->paragraph(),
            'parent_id' => $category ? $category->id : null,
            'status'=> fake()->randomElement(['active', 'archive'])
        ];
    }
}
