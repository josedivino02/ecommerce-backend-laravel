<?php

use App\Order\Http\Controllers\{CancelController, IndexController, StoreController};
use Illuminate\Support\Facades\Route;

Route::prefix("orders")->group(function (): void {
    Route::get("/", IndexController::class)->name("orders.index");
    Route::post("/", StoreController::class)->name("orders.store");
    Route::put("/{order}/cancel", CancelController::class)->name("orders.cancel");
});
