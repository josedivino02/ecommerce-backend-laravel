<?php

use App\Common\Http\Middleware\{IsAdminMiddleware};
use App\Product\Http\Controllers\{DeleteController, IndexController, StoreController, UpdateController};

use Illuminate\Support\Facades\Route;

Route::prefix("products")->middleware(IsAdminMiddleware::class)->group(function (): void {
    Route::post("/", StoreController::class)->name("products.store");
    Route::get("/", IndexController::class)->name("products.index");
    Route::put("/{product}/update", UpdateController::class)->name("products.update");
    Route::delete("/{product}/delete", DeleteController::class)->name("products.delete");
});
