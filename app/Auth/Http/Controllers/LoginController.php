<?php

namespace App\Auth\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Auth\Http\Requests\LoginRequest;
use App\Auth\Services\Auth\AuthService;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only("email", "password");

        try {
            $response = $this->authService
                ->login($credentials);

            if (!$response) {
                return $this->errorResponse(
                    message :"Invalid credentials!",
                    status: Response::HTTP_UNAUTHORIZED
                );
            }

            return $this->successResponse(
                message : "successful authenticated",
                status: Response::HTTP_OK,
                data: $response,
            );
        } catch (JWTException $e) {
            return $this->errorResponse(
                message :"It was not possible to create the token.",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}