<?php

use App\OrderItem\Http\Controllers\CancelController;
use Illuminate\Support\Facades\Route;

Route::prefix("orders")->group(function (): void {
    Route::put("/{order}/item/{item}/cancel", CancelController::class)->name("orderItems.cancel");
});
