<?php

use App\Category\Http\Controllers\{StoreController,IndexController,UpdateController, DeleteController};
use App\Common\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix("categories")->middleware(IsAdminMiddleware::class)->group(function () {
    Route::post("/", StoreController::class)->name("categories.store");
    Route::get("/", IndexController::class)->name("categories.index");
    Route::put("/{category}/update", UpdateController::class)->name("categories.update");
    Route::delete("/{category}/delete", DeleteController::class)->name("category.delete");
});
