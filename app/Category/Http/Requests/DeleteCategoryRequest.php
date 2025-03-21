<?php

namespace App\Category\Http\Requests;

use App\Category\Models\Category;
use App\Category\Rules\ValidCategoryForDelete;
use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DeleteCategoryRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "category" => $this->route("category"),
        ]);
    }

    public function authorize(): bool
    {
        return Gate::allows("delete", Category::class);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "category" => ["required", new ValidCategoryForDelete()],
        ];
    }
}
