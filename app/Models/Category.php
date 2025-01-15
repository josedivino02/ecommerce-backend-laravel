<?php

namespace App\Models;

use App\Trait\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany};
use Illuminate\Database\Eloquent\{Builder, Model};
use Symfony\Component\HttpFoundation\Response;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use Filterable;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, "sub");
    }

    public function filterName(Builder $query, $value)
    {
        $query->where("name", "like", "%" . $value . "%");
    }

    public function scopeStatus(Builder $query): Builder
    {
        return $query->where("status", "=", "active");
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $category = $this->where($field ?? "id", $value)->first();

        if (!$category) {
            abort(response()->json([
                "error" => "The category was not found",
            ], Response::HTTP_NOT_FOUND));
        }

        return $category;
    }
}
