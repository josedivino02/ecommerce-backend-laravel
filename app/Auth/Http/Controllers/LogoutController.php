<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Services\Auth\AuthService;
use App\Common\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};
use Tymon\JWTAuth\Exceptions\{JWTException, TokenExpiredException, TokenInvalidException};

class LogoutController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function __invoke(): JsonResponse
    {
        try {
            if (!$this->authService->authenticate()) {
                return $this->errorResponse(
                    message :"Token is invalid or expired!",
                    status: Response::HTTP_UNAUTHORIZED
                );
            }

            $this->authService
                ->logout();

            return $this->successResponse(
                message: "Successful logout!",
                status: Response::HTTP_OK
            );
        } catch (TokenInvalidException) {
            return $this->errorResponse(
                message :"Token is invalid!",
                status: Response::HTTP_UNAUTHORIZED
            );
        } catch (TokenExpiredException) {
            return $this->errorResponse(
                message :"Token has already expired!",
                status: Response::HTTP_UNAUTHORIZED
            );
        } catch (JWTException) {
            return $this->errorResponse(
                message :"Unable to logout, token not provided!",
                status: Response::HTTP_BAD_REQUEST
            );
        }
    }
}
