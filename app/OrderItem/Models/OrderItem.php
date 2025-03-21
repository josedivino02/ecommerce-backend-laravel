<?php

namespace App\OrderItem\Models;

use App\Common\Trait\RouteBindingResolver;
use App\Order\Models\Order;
use App\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RouteBindingResolver;

    /**
     * Get the order that owns the OrderItem.
     *
     * @return BelongsTo<Order, OrderItem>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the OrderItem.
     *
     * @return BelongsTo<Product, OrderItem>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
