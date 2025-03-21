<?php

namespace App\OrderItem\Http\Requests;

use App\Common\Trait\FailValidate;
use App\Order\Models\Order;
use App\Order\Rules\ValidOrderForCancellation;
use App\OrderItem\Models\OrderItem;

use App\OrderItem\Rules\ValidItemForCancellation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @property-read Order|null $order
 * @property-read OrderItem|null $item
 */
class CancelOrderItemRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route("order"),
            "item"  => $this->route("item"),
        ]);
    }

    public function authorize(): bool
    {
        $order = $this->route("order");
        $item  = $this->route("item");

        return Gate::allows("cancelItem", [$order, $item]);
    }

    /**
     * @return array<string, array<int, string|ValidationRule>>
     */
    public function rules(): array
    {
        return [
            "order" => ["required", new ValidOrderForCancellation()],
            "item"  => ["required", new ValidItemForCancellation()],
        ];
    }
}
