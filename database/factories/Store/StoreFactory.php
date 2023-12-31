<?php

namespace Database\Factories\Store;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store\Store>
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
        $name = fake()->unique()->name();
        return [
            'name' =>$name ,
            'description'=> fake()->paragraph(),
            'location'=> fake()->address(),
            'is_accepted'=> fake()->randomElement([true,false]),
            'status'=> fake()->randomElement(['active', 'inactive', 'blocked']),
        ];
    }
}
