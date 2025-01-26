<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only("email", "password");

        try {
            $response = $this->authService->login($credentials);

            if (!$response) {
                return response()->json(
                    ['error' => 'Invalid credentials!'],
                    Response::HTTP_UNAUTHORIZED
                );
            }

            return response()->json(
                $response,
                Response::HTTP_OK
            );

        } catch (JWTException $e) {
            return response()->json(
                ['error' => 'It was not possible to create the token.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
