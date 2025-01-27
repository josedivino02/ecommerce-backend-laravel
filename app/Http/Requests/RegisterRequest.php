<?php

namespace App\Http\Requests;

use App\Rules\ValidIsAdmin;
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name"     => ["required", "min:3", "max:255"],
            "email"    => ["required", "min:3", "max:255", "email", "unique:users,email", "confirmed"],
            "password" => ["required", "min:8", "max:40", "confirmed"],
            "isAdmin"  => ["nullable", new ValidIsAdmin()],
        ];
    }
}
