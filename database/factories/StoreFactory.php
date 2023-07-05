<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' =>$name ,
            'slug' =>Str::slug($name),
            'description'=> fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'is_accepted'=> fake()->randomElement([true,false]),
            'status'=> fake()->randomElement(['active', 'inactive', 'blocked']),
        ];
    }
}
