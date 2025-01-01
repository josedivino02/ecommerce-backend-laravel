<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\{Auth, Order};
use App\Http\Middleware\{IsAdminMiddleware, JwtAuthenticationMiddleware};
use Illuminate\Support\Facades\Route;

Route::post('/register', [Auth\RegisterController::class, 'register'])->name("register");
Route::post('/login', [Auth\LoginController::class, "login"])->name("login");

Route::middleware([JwtAuthenticationMiddleware::class])->group(function () {
    Route::post("/orders", [Order\StoreController::class, "store"])->name("orders.store");

    Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", [Product\StoreController::class, "store"])->name("products.store");
    });

    Route::post('/logout', [Auth\LogoutController::class, "logout"])->name("logout");
});
