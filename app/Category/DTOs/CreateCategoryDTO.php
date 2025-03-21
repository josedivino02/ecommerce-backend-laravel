<?php

namespace App\Category\DTOs;

use App\Category\Enums\CategoryStatus;

class CreateCategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public CategoryStatus $status,
        public string $uuid = "",
        public string $slug = "",
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
            name: $data['name'],
            status: CategoryStatus::ACTIVE,
            uuid: "",
            description: $data['description'],
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
