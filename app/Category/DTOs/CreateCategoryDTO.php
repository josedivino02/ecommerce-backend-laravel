<?php

namespace App\Category\DTOs;

use App\Category\Enums\CategoryStatus;

class CreateCategoryDTO
{
    public function __construct(
        public string $uuid = "",
        public readonly string $name,
        public readonly string $description,
        public string $slug = "",
        public CategoryStatus $status,
        public ?int $sub = null,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            uuid: "",
            slug: "",
            name: $data['name'],
            description: $data['description'],
            status: CategoryStatus::ACTIVE,
            sub: $data['subcategory'] ?? null,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}