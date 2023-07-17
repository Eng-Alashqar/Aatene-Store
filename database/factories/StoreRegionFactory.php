<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Admin\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StoreRegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id'=>Store::inRandomOrder()->first()->id,
            'region_id'=>Region::inRandomOrder()->first()->id,
        ];
    }
}
