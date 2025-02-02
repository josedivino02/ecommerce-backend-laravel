<?php

namespace App\Category\Providers;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;
use App\Category\Repositories\CategoryRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
    }

    public function boot(): void
    {
        Model::unguard();
    }
}