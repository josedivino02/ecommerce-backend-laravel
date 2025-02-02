<?php

namespace App\Common\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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