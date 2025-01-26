<?php

namespace App\Providers;

use App\Repositories\Category\{CategoryRepository, CategoryRepositoryInterface};
use App\Repositories\Item\{ItemRepository, ItemRepositoryInterface};
use App\Repositories\Order\{OrderRepository, OrderRepositoryInterface};
use App\Repositories\Product\{ProductRepository, ProductRepositoryInterface};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    public function boot(): void
    {
        Model::unguard();

        genericRateLimiter(
            "api",
            "RATE_LIMITER_API",
            "perHour"
        );
        genericRateLimiter(
            "login",
            "RATE_LIMITER_LOGIN",
            "perMinute",
            "The number of attempts has been exceeded. Please wait one minute."
        );

    }
}
