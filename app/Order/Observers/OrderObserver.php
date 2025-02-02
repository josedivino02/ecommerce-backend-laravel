<?php

namespace App\Order\Observers;

use App\Order\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{
    public function creating(Order $order): void
    {
        $order->user_id = Auth::user()->id;
    }
}