<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\ValidCategoryForDelete;
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DeleteCategoryRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "category" => $this->route()->category,
        ]);
    }

    public function authorize(): bool
    {
        return Gate::allows("delete", Category::class);
    }

    public function rules(): array
    {
        return [
            "category" => ["required", new ValidCategoryForDelete()],
        ];
    }
}
