<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Store\Favorite;
use App\Models\Users\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Users\User::factory(10)->create();
        \App\Models\Users\Admin::factory(10)->create();
        \App\Models\Store\Store::factory(10)->create();

        \App\Models\Users\Seller::factory(10)->create();
        \App\Models\Region::factory(10)->create();
        \App\Models\Store\Category::factory(10)->create();
//        Favorite::factory(20)->create();
        // DB::table('store_region')->factory('storeRegionFactory', 1000)->create();
        $role = Role::first();
        $user = Admin::factory()->create([
            'name' => 'alaa',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'last_active_at' => now(),
            'status' => 'active',
            'phone_number' => '123123123',
            'role_name' => [$role->name ?? 'Admin']
        ]);
        // $user->assignRole([$role->id]);


        \App\Models\Users\User::factory()->create([
            'name' => 'alaa',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'last_active_at' => now(),
            'status' => 'active',
            'phone_number' => '0598518618',
        ]);


        \App\Models\Users\Seller::factory()->create([
            'name' => 'alaa',
            'email' => 'seller@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'last_active_at' => now(),
            'status' => 'active',
            'phone_number' => '0598518618',
        ]);

        //         \App\Models\Store\Product::factory(100)->create();
    }
}
