<?php

namespace Database\Seeders;

use App\Category\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::create([
            'name'        => 'Eletrônicos',
            'slug'        => 'eletronicos',
            'description' => 'Produtos eletrônicos em geral',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        $fashion = Category::create([
            'name'        => 'Moda',
            'slug'        => 'moda',
            'description' => 'Roupas, calçados e acessórios',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        $homeDecor = Category::create([
            'name'        => 'Casa e Decoração',
            'slug'        => 'casa-e-decoracao',
            'description' => 'Móveis, utensílios e decoração',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        $beautyHealth = Category::create([
            'name'        => 'Beleza e Saúde',
            'slug'        => 'beleza-e-saude',
            'description' => 'Produtos de beleza e bem-estar',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        $sports = Category::create([
            'name'        => 'Esportes e Lazer',
            'slug'        => 'esportes-e-lazer',
            'description' => 'Produtos esportivos e de lazer',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

        Category::create([
            'name'        => 'Smartphones',
            'slug'        => 'smartphones',
            'sub'         => $electronics->id,
            'description' => 'Celulares e acessórios',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Notebooks',
            'slug'        => 'notebooks',
            'sub'         => $electronics->id,
            'description' => 'Notebooks e acessórios',
            "uuid"        => Str::uuid(),
            "status"      => 'active', ]);
        Category::create([
            'name'        => 'TVs e Áudio',
            'slug'        => 'tvs-e-audio',
            'sub'         => $electronics->id,
            'description' => 'Televisores, caixas de som e acessórios',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

        Category::create([
            'name'        => 'Masculina',
            'slug'        => 'masculina',
            'sub'         => $fashion->id,
            'description' => 'Roupas e calçados masculinos',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Feminina',
            'slug'        => 'feminina',
            'sub'         => $fashion->id,
            'description' => 'Roupas e calçados femininos',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Infantil',
            'slug'        => 'infantil',
            'sub'         => $fashion->id,
            'description' => 'Roupas e calçados infantis',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

        Category::create([
            'name'        => 'Móveis',
            'slug'        => 'moveis',
            'sub'         => $homeDecor->id,
            'description' => 'Sofás, mesas e armários',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Cozinha',
            'slug'        => 'cozinha',
            'sub'         => $homeDecor->id,
            'description' => 'Eletrodomésticos e utensílios',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Decoração',
            'slug'        => 'decoracao',
            'sub'         => $homeDecor->id,
            'description' => 'Quadros, cortinas e tapetes',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

        Category::create([
            'name'        => 'Cosméticos',
            'slug'        => 'cosmeticos',
            'sub'         => $beautyHealth->id,
            'description' => 'Produtos de maquiagem e cuidados com a pele',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Perfumes',
            'slug'        => 'perfumes',
            'sub'         => $beautyHealth->id,
            'description' => 'Perfumes e fragrâncias',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Saúde e Bem-estar',
            'slug'        => 'saude-bem-estar',
            'sub'         => $beautyHealth->id,
            'description' => 'Suplementos e vitaminas',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

        Category::create([
            'name'        => 'Fitness',
            'slug'        => 'fitness',
            'sub'         => $sports->id,
            'description' => 'Equipamentos e acessórios para exercícios',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Camping e Aventura',
            'slug'        => 'camping-aventura',
            'sub'         => $sports->id,
            'description' => 'Itens para acampamento e trilhas',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);
        Category::create([
            'name'        => 'Esportes Coletivos',
            'slug'        => 'esportes-coletivos',
            'sub'         => $sports->id,
            'description' => 'Produtos para esportes como futebol e basquete',
            "uuid"        => Str::uuid(),
            "status"      => 'active',
        ]);

    }
}
