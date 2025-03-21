<?php

namespace App\Order\Http\Requests;

use App\Common\Trait\FailValidate;
use App\Order\Rules\ValidOrderForCancellation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CancelOrderRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route("order"),
        ]);
    }

    public function authorize(): bool
    {
        $order = $this->route("order");

        return $order && Gate::allows("cancel", $order);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            "order" => ["required", new ValidOrderForCancellation()],
        ];
    }
}
