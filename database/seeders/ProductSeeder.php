<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            "name"        => "Camiseta Básica",
            "description" => "Camiseta de algodão, disponível em várias cores e tamanhos.",
            "price"       => 49.90,
            "stock"       => 150,
            "sku"         => "CAM001",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);

        Product::create([
            "name"        => "Smartphone XYZ",
            "description" => "Smartphone com 6GB de RAM, 128GB de armazenamento, câmera de 48MP.",
            "price"       => 1999.99,
            "stock"       => 50,
            "sku"         => "SMX12345",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);

        Product::create([
            "name"        => "Chocolate ao Leite",
            "description" => "Chocolate ao leite de 200g, com 30% de cacau.",
            "price"       => 7.50,
            "stock"       => 500,
            "sku"         => "CHO200G",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);

        Product::create([
            "name"        => "Óculos de Sol",
            "description" => "Óculos de sol estilo aviador, lentes UV400, armação dourada.",
            "price"       => 120.00,
            "stock"       => 200,
            "sku"         => "OCUAV123",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);

        Product::create([
            "name"        => "Tênis Esportivo",
            "description" => "Tênis esportivo confortável, disponível nos tamanhos 38 ao 44.",
            "price"       => 159.90,
            "stock"       => 80,
            "sku"         => "TENE38",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);

        Product::create([
            "name"        => "Jogo de Panelas",
            "description" => "Jogo com 5 panelas antiaderentes, de alumínio fundido.",
            "price"       => 299.90,
            "stock"       => 120,
            "sku"         => "PANALUX5",
            "user_id"     => 1,
            "uuid"        => Str::uuid(),
        ]);
    }
}
