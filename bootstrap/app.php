<?php

use App\Common\Http\Middleware\JwtAuthenticationMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function() {
            Route::prefix("api")
                ->middleware("api")
                ->group(base_path("app/Auth/routes/api.php"))
                ->group(function() {
                    Route::middleware([JwtAuthenticationMiddleware::class, "throttle:api"])
                        ->group(base_path("app/Category/routes/api.php"))
                        ->group(base_path("app/Order/routes/api.php"))
                        ->group(base_path("app/OrderItem/routes/api.php"))
                        ->group(base_path("app/Product/routes/api.php"));
                });
            }
    )
    ->withMiddleware(function (Middleware $middleware) {

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
