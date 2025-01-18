<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\{Auth, Category, Order, OrderItem};
use App\Http\Middleware\{IsAdminMiddleware, JwtAuthenticationMiddleware};
use Illuminate\Support\Facades\Route;

Route::post("/register", [Auth\RegisterController::class, "register"])->name("register");
Route::middleware(["throttle:login"])->post("/login", [Auth\LoginController::class, "login"])->name("login");

Route::middleware([JwtAuthenticationMiddleware::class, "throttle:api"])->group(function () {
    Route::prefix("orders")->group(function () {
        Route::post("/", [Order\StoreController::class, "store"])->name("orders.store");
        Route::put("/{order}/cancel", [Order\CancelController::class, "cancel"])->name("orders.cancel");
        Route::put("/{order}/item/{item}/cancel", [OrderItem\CancelController::class, "cancel"])->name("orderItems.cancel");
    });

    Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", [Product\StoreController::class, "store"])->name("products.store");
        Route::get("/", [Product\IndexController::class, "index"])->name("products.index");
        Route::put("/{product}/update", [Product\UpdateController::class, "update"])->name("products.update");
    });

    Route::prefix("categories")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", [Category\StoreController::class, "store"])->name("categories.store");
        Route::get("/", [Category\IndexController::class, "index"])->name("categories.index");
        Route::put("/{category}/update", [Category\UpdateController::class, "update"])->name("categories.update");
        Route::delete("/{category}/delete", [Category\DeleteController::class, "delete"])->name("category.delete");
    });

    Route::post("/logout", [Auth\LogoutController::class, "logout"])->name("logout");
});
