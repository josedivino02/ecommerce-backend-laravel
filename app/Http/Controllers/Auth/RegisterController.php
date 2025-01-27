<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\User\CreateUserService;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(protected CreateUserService $userService)
    {
    }

    public function register(RegisterRequest $request)
    {
        $this->userService
            ->create($request->validated());

        return response()->json(
            ["message" => "User successfully registered"],
            Response::HTTP_CREATED
        );
    }
}
