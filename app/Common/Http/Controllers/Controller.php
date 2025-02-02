<?php

namespace App\Common\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller
{
    protected function successResponse($data = "", string $message = "", int $status = 200): JsonResponse
    {
        $responseSuccess = ["status" => "success"];

        if(!empty($message)) $responseSuccess["message"] = $message;
        if(!empty($data)) $responseSuccess["data"] = $data;

        return response()->json(
            $responseSuccess,
            $status
        );
    }

    protected function errorResponse(string $message, int $status = 400, $errors = null): JsonResponse
    {
        $responseError = ["status" => "error"];

        if(!empty($message)) $responseError["message"] = $message;
        if(!empty($errors)) $responseError["errors"] = $errors;

        return response()->json(
            $responseError,
            $status
            );
    }
}