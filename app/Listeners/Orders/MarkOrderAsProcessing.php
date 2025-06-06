<?php

namespace App\Listeners\Orders;

use App\Models\Order;

class MarkOrderAsProcessing
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->order->update([
            'status' => Order::PROCESSING
        ]);
    }
}
