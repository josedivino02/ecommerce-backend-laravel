<?php

namespace Database\Seeders;

use App\Models\ShippingCost;
use Illuminate\Database\Seeder;

class ShippingCostSeeder extends Seeder
{
    public function run(): void
    {
        ShippingCost::create([
            "name"   => "Free",
            "cost"   => 1.00,
            "status" => "active",
        ]);

        ShippingCost::create([
            "name"   => "Express",
            "cost"   => 25.00,
            "status" => "active",
        ]);

        ShippingCost::create([
            "name"   => "Standard",
            "cost"   => 10.00,
            "status" => "active",
        ]);
    }
}
