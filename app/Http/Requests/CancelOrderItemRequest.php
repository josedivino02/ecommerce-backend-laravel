<?php

namespace App\Http\Requests;

use App\Rules\{ValidItemForCancellation, ValidOrderForCancellation};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CancelOrderItemRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route()->order,
            "item"  => $this->route()->item,
        ]);
    }

    public function authorize(): bool
    {
        $order = $this->route()->order;
        $item  = $this->route()->item;

        return Gate::allows("cancelItem", [$order, $item]);
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ["errors" => $validator->errors(),
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }

    public function rules(): array
    {
        return [
            "order" => ["required", new ValidOrderForCancellation()],
            "item"  => ["required", new ValidItemForCancellation()],
        ];
    }
}
