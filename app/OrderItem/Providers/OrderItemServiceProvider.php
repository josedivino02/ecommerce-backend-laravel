<?php

namespace App\OrderItem\Providers;

use App\OrderItem\Contracts\Repositories\OrderItemRepositoryInterface;
use App\OrderItem\Repositories\OrderItemRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class OrderItemServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderItemRepositoryInterface::class,
            OrderItemRepository::class
        );
    }

    public function boot(): void
    {
        Model::unguard();
    }
}
