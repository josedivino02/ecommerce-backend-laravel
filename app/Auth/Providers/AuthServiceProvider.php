<?php

namespace App\Auth\Providers;

use App\Auth\Contracts\Repositories\UserRepositoryInterface;
use App\Auth\Contracts\Services\AuthServiceInterface;
use App\Auth\Repositories\UserRepository;
use App\Auth\Services\Auth\JwtAuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            AuthServiceInterface::class,
            JwtAuthService::class
        );
    }

    public function boot(): void
    {
    }
}
