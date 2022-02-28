<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Listeners\Orders\CreateTransaction;
use App\Events\Orders\OrderPaymentSuccessful;

class CreateTransactionListenerTest extends TestCase
{
    /** @test */
    public function it_creates_a_transaction()
    {
        $user = User::factory()->create();

        $user->orders()->save(
            $order = Order::factory()->make()
        );

        $event = new OrderPaymentSuccessful($order);

        $listener = new CreateTransaction();
        $listener->handle($event);

        $this->assertDatabaseHas('transactions', [
            'order_id' => $order->id,
            'total' => $order->total()->getAmount()
        ]);
    }
}
