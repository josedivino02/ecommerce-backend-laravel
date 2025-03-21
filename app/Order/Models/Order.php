<?php

namespace App\Order\Models;

use App\Auth\Models\User;
use App\Common\Trait\{Filterable, RouteBindingResolver};
use App\Order\Enums\OrderStatus;
use App\OrderItem\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use RouteBindingResolver;

    /**
 * Get the order items for this order.
 *
 * @return HasMany<OrderItem, Order>
 */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user who owns this order.
     *
     * @return BelongsTo<User, Order>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shipping cost associated with this order.
     *
     * @return BelongsTo<ShippingCost, Order>
     */
    public function shippingCost(): BelongsTo
    {
        return $this->belongsTo(ShippingCost::class);
    }

    /**
     * Filter by payment method.
     *
     * @param string|int $value
     */
    public function filterPaymentMethod(Builder $query, $value): Builder
    {
        return $query->where("payment_method", $value);
    }

    /**
     * Filter by payment status.
     *
     * @param string|int $value
     */
    public function filterPaymentStatus(Builder $query, $value): Builder
    {
        return $query->where("payment_status", $value);
    }

    /**
     * Filter by shipping method.
     *
     * @param string|int $value
     */
    public function filterShippingMethod(Builder $query, $value): Builder
    {
        return $query->where("shipping_method", $value);
    }

    /**
     * Filter by shipping status.
     *
     * @param string|int $value
     */
    public function filterShippingStatus(Builder $query, $value): Builder
    {
        return $query->where("shipping_status", $value);
    }

    /**
     * Filter by shipping address.
     */
    public function filterShippingAddress(Builder $query, string $value): Builder
    {
        return $query->where("shipping_address", "like", "%" . $value . "%");
    }

    /**
     * Filter by price range.
     *
     * @param Builder<Order> $query
     * @param string $value
     * @return Builder<Order>
     */
    public function filterPrice(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", (string) $value);

        return $query->whereBetween("total_price", [$firstValue, $secondValue]);
    }

    /**
     * Filter by status.
     *
     * @param Builder<Order> $query
     * @param string $value
     * @return Builder<Order>
     */
    public function filterStatus(Builder $query, $value): Builder
    {
        return $query->where("status", $value);
    }

    /**
     * Filter by shipping costs.
     *
     * @param Builder<Order> $query
     * @param string $value
     * @return Builder<Order>
     */
    public function filterShippingCosts(Builder $query, $value): Builder
    {
        return $query->where("shipping_costs_id", $value);
    }

    /**
     * Scope for status.
     *
     * @param Builder<Order> $query
     * @return Builder<Order>
     */
    public function scopeStatus(Builder $query): Builder
    {
        return $query->whereIn("status", [
            OrderStatus::COMPLETED->value,
            OrderStatus::PROCESSING->value,
            OrderStatus::PENDING->value,
            OrderStatus::CANCELED->value,
        ]);
    }
}
