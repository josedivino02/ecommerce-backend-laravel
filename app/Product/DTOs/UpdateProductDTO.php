<?php

namespace App\Product\DTOs;

use App\Product\Enums\ProductStatus;

class UpdateProductDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public ?ProductStatus $status = null,
        public readonly ?float $price = null,
        public readonly ?int $stock = null,
        public readonly ?string $sku = null,
        public readonly ?string $image_url = null,
        public readonly ?int $category_id = null,
    ) {
    }

    /**
     * Create a new UpdateProductDTO instance.
     *
     * @param array<string, mixed> $data
     */
    public static function make(array $data): self
    {
        return new self(
            name: $data["name"] ?? null,
            description: $data["description"] ?? null,
            status: $data["status"] ?? null,
            price: $data["price"] ?? null,
            stock: $data["stock"] ?? null,
            sku: $data["sku"] ?? null,
            image_url: $data["image_url"] ?? null,
            category_id: $data["category"] ?? null,
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
