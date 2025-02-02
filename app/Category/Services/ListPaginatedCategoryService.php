<?php

namespace App\Category\Services;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;

use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatedCategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function listPaginated(array $params = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->categoryRepository
            ->listPaginated(
                $params,
                $perPage
            );
    }
}