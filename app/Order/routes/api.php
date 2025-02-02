<?php

use App\Order\Http\Controllers\CancelController;
use App\Order\Http\Controllers\StoreController;

use Illuminate\Support\Facades\Route;

Route::prefix("orders")->group(function () {
    Route::post("/", StoreController::class)->name("orders.store");
    Route::put("/{order}/cancel", CancelController::class)->name("orders.cancel");
});