<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Rules\{ValidItemForCancellation, ValidOrderForCancellation};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CancelOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        $order = Order::withTrashed()
            ->where("uuid", $this->route()->order)
            ->first();

        $item = $order->orderItems()
            ->withTrashed()
            ->where("uuid", $this->route()->item)
            ->first();

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

    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route()->order,
            "item"  => $this->route()->item,
        ]);
    }
    public function rules(): array
    {

        return [
            "order" => ["required", "string", "uuid", new ValidOrderForCancellation()],
            "item"  => ["required", "string", "uuid", new ValidItemForCancellation()],
        ];
    }

    public function messages()
    {
        return [
            'order.uuid' => 'O UUID fornecido não é válido.',
            'item.uuid'  => 'O UUID fornecido não é válido.',
        ];
    }

}
