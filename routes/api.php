<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\{Auth, Category, Order, OrderItem};
use App\Http\Middleware\{IsAdminMiddleware, JwtAuthenticationMiddleware};
use Illuminate\Support\Facades\Route;

Route::post("/register", Auth\RegisterController::class)->name("register");
Route::middleware(["throttle:login"])->post("/login", Auth\LoginController::class)->name("login");

Route::middleware([JwtAuthenticationMiddleware::class, "throttle:api"])->group(function () {
    Route::prefix("orders")->group(function () {
        Route::post("/", Order\StoreController::class)->name("orders.store");
        Route::put("/{order}/cancel", Order\CancelController::class)->name("orders.cancel");
        Route::put("/{order}/item/{item}/cancel", OrderItem\CancelController::class)->name("orderItems.cancel");
    });

    Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", Product\StoreController::class)->name("products.store");
        Route::get("/", Product\IndexController::class)->name("products.index");
        Route::put("/{product}/update", Product\UpdateController::class)->name("products.update");
        Route::delete("/{product}/delete", Product\DeleteController::class)->name("products.delete");
    });

    Route::prefix("categories")->middleware(IsAdminMiddleware::class)->group(function () {
        Route::post("/", Category\StoreController::class)->name("categories.store");
        Route::get("/", Category\IndexController::class)->name("categories.index");
        Route::put("/{category}/update", Category\UpdateController::class)->name("categories.update");
        Route::delete("/{category}/delete", Category\DeleteController::class)->name("category.delete");
    });

    Route::post("/logout", Auth\LogoutController::class)->name("logout");
});