<?php

namespace App\Product\Observers;

use App\Product\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function creating(Product $product): void
    {
        $product->user_id = Auth::user()->id;
    }
}