<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\{Auth, Order, OrderItem};
use App\Http\Middleware\{IsAdminMiddleware, JwtAuthenticationMiddleware};
use Illuminate\Support\Facades\Route;

Route::post('/register', [Auth\RegisterController::class, 'register'])->name("register");
Route::post('/login', [Auth\LoginController::class, "login"])->name("login");

Route::middleware([JwtAuthenticationMiddleware::class])->group(function () {
    Route::prefix("orders")->group(function () {
        Route::post("/", [Order\StoreController::class, "store"])->name("orders.store");
        Route::put("/{order}/cancel", [Order\CancelController::class, "cancel"])->name("orders.cancel");
        Route::put("/{order}/item/{item}/cancel", [OrderItem\CancelController::class, "cancel"])->name("orderItems.cancel");
    });

    Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", [Product\StoreController::class, "store"])->name("products.store");
    });

    Route::post('/logout', [Auth\LogoutController::class, "logout"])->name("logout");
});
