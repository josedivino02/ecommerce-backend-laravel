<?php

use App\Http\Controllers\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {

    return User::all();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post("orders", Order\StoreController::class)->name("orders.store");
});
