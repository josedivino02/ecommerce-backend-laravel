<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
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
