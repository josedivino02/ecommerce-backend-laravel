<?php

namespace Database\Seeders;

use App\Order\Models\ShippingCost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShippingCostSeeder extends Seeder
{
    public function run(): void
    {
        ShippingCost::create([
            "name"   => "Free",
            "cost"   => 1.00,
            "status" => "active",
            "uuid"   => Str::uuid(),
        ]);

        ShippingCost::create([
            "name"   => "Express",
            "cost"   => 25.00,
            "status" => "active",
            "uuid"   => Str::uuid(),
        ]);

        ShippingCost::create([
            "name"   => "Standard",
            "cost"   => 10.00,
            "status" => "active",
            "uuid"   => Str::uuid(),
        ]);
    }
}