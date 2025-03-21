<?php

namespace App\Product\Providers;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;
use App\Product\Models\Product;
use App\Product\Observers\ProductObserver;
use App\Product\Repositories\ProductRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    public function boot(): void
    {
        Model::unguard();
        Product::observe(ProductObserver::class);
    }
}
