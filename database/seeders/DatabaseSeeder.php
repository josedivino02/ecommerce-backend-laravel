<?php

namespace Database\Seeders;

use App\Auth\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ShippingCostSeeder::class);

        User::factory()->create([
            'name'     => env('USER_NAME', 'Test User'),
            'email'    => env('USER_EMAIL', 'test@example.com'),
            'password' => Hash::make(env('USER_PASSWORD', '123456')),
            'isAdmin'  => "S",
        ]);
    }
}