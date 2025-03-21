<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\RegisterRequest;
use App\Auth\Services\User\CreateUserService;
use App\Common\Http\Controllers\Controller;

use Exception;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class RegisterController extends Controller
{
    public function __construct(protected CreateUserService $userService)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $this->userService
                ->create($request->validated());

            return $this->successResponse(
                message: "User successfully registered",
                status: Response::HTTP_CREATED
            );
        } catch (Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
