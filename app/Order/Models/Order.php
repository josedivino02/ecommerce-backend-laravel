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

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingCost(): BelongsTo
    {
        return $this->belongsTo(ShippingCost::class);
    }

    public function filterPaymentMethod(Builder $query, $value): Builder
    {
        return $query->where("payment_method", $value);
    }

    public function filterPaymentStatus(Builder $query, $value): Builder
    {
        return $query->where("payment_status", $value);
    }

    public function filterShippingMethod(Builder $query, $value): Builder
    {
        return $query->where("shipping_method", $value);
    }

    public function filterShippingStatus(Builder $query, $value): Builder
    {
        return $query->where("shipping_status", $value);
    }

    public function filterShippingAddress(Builder $query, $value): Builder
    {
        return $query->where("shipping_address", "like", "%" . $value . "%");
    }

    public function filterPrice(Builder $query, $value): Builder
    {
        [$firstValue, $secondValue] = explode(",", $value);

        return $query->whereBetween("total_price", [$firstValue, $secondValue]);
    }

    public function filterStatus(Builder $query, $value): Builder
    {
        return $query->where("status", $value);
    }

    public function filterShippingCosts(Builder $query, $value): Builder
    {
        return $query->where("shipping_costs_id", $value);
    }

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
