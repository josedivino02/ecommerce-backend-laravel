<?php

namespace App\Models;

use App\Trait\RouteBindingResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
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
}
