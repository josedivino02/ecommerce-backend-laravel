<?php

use App\Auth\Http\Controllers\{LoginController, LogoutController, RegisterController};
use App\Common\Http\Middleware\{JwtAuthenticationMiddleware};

use Illuminate\Support\Facades\Route;

Route::post("/register", RegisterController::class)->name("register");
Route::middleware(["throttle:login"])
    ->post("/login", LoginController::class)
    ->name("login");
Route::middleware([JwtAuthenticationMiddleware::class])
    ->post("/logout", LogoutController::class)
    ->name("logout");
