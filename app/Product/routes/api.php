<?php

use App\Common\Http\Middleware\IsAdminMiddleware;
use App\Common\Http\Middleware\JwtAuthenticationMiddleware;
use App\Product\Http\Controllers\{IndexController, StoreController, UpdateController, DeleteController};

use Illuminate\Support\Facades\Route;

Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function () {
    Route::post("/", StoreController::class)->name("products.store");
    Route::get("/", IndexController::class)->name("products.index");
    Route::put("/{product}/update", UpdateController::class)->name("products.update");
    Route::delete("/{product}/delete", DeleteController::class)->name("products.delete");
});