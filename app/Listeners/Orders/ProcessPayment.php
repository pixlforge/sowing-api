<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderCreated;
use App\Events\Orders\OrderPaymentFailed;
use App\Exceptions\PaymentFailedException;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Orders\OrderPaymentSuccessful;
use App\Payments\Contracts\PaymentGatewayContract;

class ProcessPayment implements ShouldQueue
{
    /**
     * The gateway property.
     *
     * @var PaymentGatewayContract
     */
    protected $gateway;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaymentGatewayContract $gateway)
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

        try {
            $charge = $this->gateway->withUser($order->user)
            ->getOrCreateCustomer()
            ->charge(
                $order->paymentMethod,
                $order->total()->getAmount()
            );

            // The charge contains the id used necessary for the transfer_group
            // dump($charge);

            event(new OrderPaymentSuccessful($order));
        } catch (PaymentFailedException $e) {
            event(new OrderPaymentFailed($order));
        }
    }
}
