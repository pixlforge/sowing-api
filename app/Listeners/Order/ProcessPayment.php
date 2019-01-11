<?php

namespace App\Listeners\Order;

use App\Events\Orders\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\PaymentGateways\Contracts\PaymentGateway;

class ProcessPayment implements ShouldQueue
{
    /**
     * The gateway property.
     *
     * @var PaymentGateway
     */
    protected $gateway;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        $this->gateway->withUser($order->user)
            ->getCustomer()
            ->charge(
                $order->paymentMethod,
                $order->total()->amount()
            );
    }
}
