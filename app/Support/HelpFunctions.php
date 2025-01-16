<?php

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

function user(): ?User
{
    if (auth()->check()) {
        return auth()->user();
    }

    return null;
}

function genericRateLimiter(
    string $name,
    string $envName,
    string $limitMethod,
    string $errorMessage = "The system is receiving an excessive number of requests. Please reduce the request rate."
): void {
    RateLimiter::for($name, function (Request $request) use ($envName, $limitMethod, $errorMessage): mixed {
        return Limit::$limitMethod(env($envName, 1))
            ->by(user()?->id ?? $request->ip())
            ->response(function () use ($errorMessage): JsonResponse {
                return response()->json(
                    [
                        "error" => $errorMessage,
                    ],
                    Response::HTTP_TOO_MANY_REQUESTS
                );
            });
    });
}
