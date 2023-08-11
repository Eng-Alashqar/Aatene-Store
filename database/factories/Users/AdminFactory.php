<?php

namespace Database\Factories\Users;

use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'super_admin'=> fake()->randomElement([0,1]),
            'last_active_at' => now(),
            'status'=>fake()->randomElement(['active', 'inactive', 'blocked']),
            'phone_number'=>'0598518618',
        ];
    }
}
