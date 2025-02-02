<?php

namespace App\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && user()->isAdmin === 'S') {
            return $next($request);
        }

        return response()->json(
            [
                "error" => "Access denied. Your account is not an administrator.",
            ],
            Response::HTTP_FORBIDDEN
        );
    }
}