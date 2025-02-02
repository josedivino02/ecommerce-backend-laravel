<?php

namespace App\Order\Providers;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;
use App\Order\Models\Order;
use App\Order\Observers\OrderObserver;
use App\Order\Repositories\OrderRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
            );
    }

    public function boot(): void
    {
        Model::unguard();
        Order::observe(OrderObserver::class);
    }
}