<?php

namespace App\Models;

use App\Trait\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany};
use Illuminate\Database\Eloquent\{Builder, Model};

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
}
