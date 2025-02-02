<?php

namespace App\Product\Models;

use App\Auth\Models\User;
use App\Category\Models\Category;
use App\Common\Trait\{Filterable, RouteBindingResolver};
use App\OrderItem\Models\OrderItem;
use App\Product\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use RouteBindingResolver;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function filterName(Builder $query, $value): Builder
    {
        return $query->where("name", "like", "%" . $value . "%");
    }

    public function filterSku(Builder $query, $value): Builder
    {
        return $query->where("sku", $value);
    }

    public function filterPrice(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", $value);

        return $query->whereBetween("price", [$firstValue, $secondValue]);
    }

    public function filterStock(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", $value);

        return $query->whereBetween("stock", [$firstValue, $secondValue]);
    }

    public function scopeStatus(Builder $query): Builder
    {
        return $query->where("status", ProductStatus::ACTIVE->value);
    }
}
