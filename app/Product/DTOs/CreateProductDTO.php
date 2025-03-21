<?php

namespace App\Product\DTOs;

use App\Product\Enums\ProductStatus;

class CreateProductDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public ProductStatus $status,
        public float $price,
        public int $stock,
        public string $sku,
        public int $category_id,
        public string $uuid = "",
        public ?string $image_url = null,
    ) {
    }

    /**
     * Create a new CreateProductDTO instance.
     *
     * @param array<string, mixed> $data
     */
    public static function make(array $data): self
    {
        return new self(
            name: $data["name"],
            description: $data["description"],
            status: ProductStatus::ACTIVE,
            price: $data["price"],
            stock: $data["stock"],
            sku: $data["sku"],
            category_id: $data["category"],
            uuid: "",
            image_url: $data["image_url"] ?? null,
        );
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
