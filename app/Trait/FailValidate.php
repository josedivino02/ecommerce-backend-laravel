<?php

namespace App\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait FailValidate
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
