<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\CreateUserService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        }catch(Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}