<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
        } catch (TokenInvalidException $e) {
            return $this->errorResponse(
                message :"Token is invalid!",
                status: Response::HTTP_UNAUTHORIZED
            );
        } catch (TokenExpiredException $e) {
            return $this->errorResponse(
                message :"Token has already expired!",
                status: Response::HTTP_UNAUTHORIZED
            );
        } catch (JWTException $e) {
            return $this->errorResponse(
                message :"Unable to logout, token not provided!",
                status: Response::HTTP_BAD_REQUEST
            );
        }
    }
}