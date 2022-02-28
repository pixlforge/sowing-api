<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\Order;
use App\Events\Orders\OrderPaymentSuccessful;
use App\Listeners\Orders\MarkOrderAsProcessing;

class MarkOrderAsProcessingListenerTest extends TestCase
{
    /** @test */
    public function it_marks_the_order_as_processing()
    {
        $order = Order::factory()->create();

        $event = new OrderPaymentSuccessful($order);
        
        $this->assertEquals(Order::PENDING, $order->status);

        $listener = new MarkOrderAsProcessing();
        $listener->handle($event);

        $this->assertEquals(Order::PROCESSING, $order->status);
    }
}
