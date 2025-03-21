<?php

namespace App\Category\Models;

use App\Common\Trait\{Filterable, RouteBindingResolver};
use App\Product\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany};
use Illuminate\Database\Eloquent\{Builder, Model};

class Category extends Model
{
    use HasFactory;
    use Filterable;
    use RouteBindingResolver;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, "sub");
    }

    public function filterName(Builder $query, string $value): void
    {
        $query->where("name", "like", "%" . $value . "%");
    }

    public function scopeStatus(Builder $query): Builder
    {
        return $query->where("status", "=", "active");
    }
}
