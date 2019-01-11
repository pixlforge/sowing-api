<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\Order;
use App\Events\Orders\OrderPaymentFailed;
use App\Listeners\Orders\MarkOrderAsPaymentFailed;

class MarkOrderAsPaymentFailedListenerTest extends TestCase
{
    /** @test */
    public function it_marks_the_order_as_payment_failed()
    {
        $order = factory(Order::class)->create();

        $event = new OrderPaymentFailed($order);
        
        $this->assertEquals(Order::PENDING, $order->status);

        $listener = new MarkOrderAsPaymentFailed();
        $listener->handle($event);

        $this->assertEquals(Order::PAYMENT_FAILED, $order->status);
    }
}
