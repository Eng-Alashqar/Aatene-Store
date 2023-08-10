<?php

namespace Database\Factories;

use App\Models\Store\Store;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['completed', 'refunded', 'expired']),
        ];
    }
}
