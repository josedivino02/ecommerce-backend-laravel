<?php

namespace App\Auth\Http\Requests;

use App\Auth\Rules\ValidIsAdmin;
use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name"     => ["required", "min:3", "max:255"],
            "email"    => ["required", "min:3", "max:255", "email", "unique:users,email", "confirmed"],
            "password" => ["required", "min:8", "max:40", "confirmed"],
            "isAdmin"  => ["nullable", new ValidIsAdmin()],
        ];
    }
}
