<?php

namespace App\Models;

use App\Trait\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany};

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

    public function filterName($query, $value)
    {
        $query->where("name", "like", "%" . $value . "%");
    }

    public function filterStatus($query, $value)
    {
        $query->where("status", $value);
    }
}
