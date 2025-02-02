<?php

namespace Database\Seeders;

use App\Product\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desativar o Observer temporariamente
        Product::unsetEventDispatcher();

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ShippingCostSeeder::class);

        // Reativar o Observer depois do seeder (caso necessário)
        Product::setEventDispatcher(app('events'));
    }
}
