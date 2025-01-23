<?php

namespace App\Repositories\Category;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function create(array $data): Category;
    public function listPaginated(?array $params, ?int $perPage): Category;
}
