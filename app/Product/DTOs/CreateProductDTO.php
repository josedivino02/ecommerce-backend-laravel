<?php

namespace App\Product\DTOs;

use App\Product\Enums\ProductStatus;

class CreateProductDTO
{
    public function __construct(
        public string $uuid = "",
        public readonly string $name,
        public readonly string $description,
        public ProductStatus $status,
        public float $price,
        public int $stock,
        public string $sku,
        public ?string $image_url = null,
        public int $category_id,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            uuid: "",
            name: $data["name"],
            description: $data["description"],
            status: ProductStatus::ACTIVE,
            price: $data["price"],
            stock: $data["stock"],
            sku: $data["sku"],
            image_url: $data["image_url"] ?? null,
            category_id: $data["category"],
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}