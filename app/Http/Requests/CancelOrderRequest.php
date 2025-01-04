<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Rules\ValidOrderForCancellation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CancelOrderRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route()->order,
        ]);
    }

    public function authorize(): bool
    {
        $order = Order::withTrashed()
            ->where('uuid', $this->route()->order)
            ->first();

        return $order && Gate::allows("cancel", $order);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function rules(): array
    {
        return [
            "order" => ["required", "string", new ValidOrderForCancellation()],
        ];
    }
}
