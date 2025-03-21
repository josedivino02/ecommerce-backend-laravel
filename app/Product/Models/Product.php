<?php

namespace App\Product\Models;

use App\Auth\Models\User;
use App\Category\Models\Category;
use App\Common\Trait\{Filterable, RouteBindingResolver};
use App\OrderItem\Models\OrderItem;
use App\Product\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\{HasFactory};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};

/**
 * @method static Builder|Product query()
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use RouteBindingResolver;

    /**
     * Relationship with the User.
     *
     * @return BelongsTo<User, Product>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Relationship with the OrderItems.
    *
    * @return HasMany<OrderItem, Product>
    */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship with the Category.
     *
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Filter for the name.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function filterName(Builder $query, string $value): Builder
    {
        return $query->where("name", "like", "%" . $value . "%");
    }

    /**
     * Filter for the SKU.
     *
     * @param Builder<Product> $query
     * @param string|int $value
     * @return Builder<Product>
     */
    public function filterSku(Builder $query, $value): Builder
    {
        return $query->where("sku", $value);
    }

    /**
     * Filter for the price.
     *
     * @param Builder<Product> $query
     * @param string $value
     * @return Builder<Product>
     */
    public function filterPrice(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", (string) $value);

        return $query->whereBetween("price", [$firstValue, $secondValue]);
    }

    /**
     * Filter for the Stock.
     *
     * @param Builder<Product> $query
     * @param string $value
     * @return Builder<Product>
     */
    public function filterStock(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", (string) $value);

        return $query->whereBetween("stock", [$firstValue, $secondValue]);
    }

    /**
     * Scope for active status.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeStatus(Builder $query): Builder
    {
        return $query->where("status", ProductStatus::ACTIVE->value);
    }
}
