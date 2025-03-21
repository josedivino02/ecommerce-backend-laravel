<?php

namespace App\Auth\Http\Requests;

use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "email"    => ["required", "email"],
            "password" => ["required"],
        ];
    }
}
