<?php

namespace App\Http\Requests\Auth;

use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email"    => ["required", "email"],
            "password" => ["required"],
        ];
    }
}