<?php

use App\Http\Controllers\{Auth, Order};
use Illuminate\Support\Facades\Route;

Route::post('/register', [Auth\RegisterController::class, 'register'])->name("register");
Route::post('/login', [Auth\LoginController::class, "login"])->name("login");

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [Auth\LogoutController::class, "logout"])->name("logout");
    Route::post("/orders", [Order\StoreController::class, "store"])->name("orders.store");
});
