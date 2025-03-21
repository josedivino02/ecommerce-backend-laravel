<?php

namespace App\Category\DTOs;

use App\Category\Enums\CategoryStatus;

class UpdateCategoryDTO
{
    public function __construct(
        public ?CategoryStatus $status = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public ?string $slug = null,
        public ?int $sub = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function make(array $data): self
    {
        return new self(
            slug: "",
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            status: $data["status"] ?? null,
            sub: $data['subcategory'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
