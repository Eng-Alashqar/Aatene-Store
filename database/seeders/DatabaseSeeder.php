<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory(10)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Store::factory(10)->create();
        \App\Models\Seller::factory(10)->create();
        \App\Models\Admin\Region::factory(10)->create();
        \App\Models\Admin\Category::factory(10)->create();
        Favorite::factory(20)->create();
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
            'phone_number' => '0598518618',
            'role_name' => [$role->name ?? 'Admin']
        ]);
        // $user->assignRole([$role->id]);


        \App\Models\User::factory()->create([
            'name' => 'alaa',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'last_active_at' => now(),
            'status' => 'active',
            'phone_number' => '0598518618',
        ]);


        \App\Models\Seller::factory()->create([
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
