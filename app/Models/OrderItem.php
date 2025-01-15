<?php

namespace App\Models;

use App\Trait\RouteBindingResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RouteBindingResolver;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
