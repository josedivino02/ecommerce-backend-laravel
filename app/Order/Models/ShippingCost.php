<?php

namespace App\Order\Models;

use App\Common\Trait\RouteBindingResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ShippingCost extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RouteBindingResolver;

    /**
     * Defines the relationship between a shipping cost and orders.
     *
     * @return HasMany<Order, ShippingCost>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
