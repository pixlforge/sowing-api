<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderPaymentSuccessful;

class CreateTransaction
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPaymentSuccessful $event)
    {
        $event->order->transactions()->create([
            'total' => $event->order->total()->getAmount()
        ]);
    }
}
