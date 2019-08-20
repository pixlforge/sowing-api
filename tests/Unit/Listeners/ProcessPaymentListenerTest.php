<?php

namespace Tests\Unit\Listeners;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Events\Orders\OrderCreated;
use Illuminate\Support\Facades\Event;
use App\Listeners\Orders\ProcessPayment;
use App\Events\Orders\OrderPaymentFailed;
use App\Exceptions\PaymentFailedException;
use App\Events\Orders\OrderPaymentSuccessful;
use App\PaymentGateways\Stripe\StripePaymentGateway;
use App\PaymentGateways\Stripe\StripeGatewayCustomer;

class ProcessPaymentListenerTest extends TestCase
{
    /** @test */
    public function it_charges_the_chosen_payment_method_the_correct_amount()
    {
        Event::fake();

        list($user, $paymentMethod, $order, $event) = $this->createEvent();

        list($gateway, $customer) = $this->mockFlow();

        $customer->shouldReceive('charge')
            ->with(
                $order->paymentMethod,
                $order->total()->getAmount()
            );

        $listener = new ProcessPayment($gateway);
        $listener->handle($event);
    }

    /** @test */
    public function it_fires_the_order_payment_successful_event()
    {
        Event::fake();

        list($user, $paymentMethod, $order, $event) = $this->createEvent();

        list($gateway, $customer) = $this->mockFlow();

        $customer->shouldReceive('charge')
            ->with(
                $order->paymentMethod,
                $order->total()->getAmount()
            );

        $listener = new ProcessPayment($gateway);
        $listener->handle($event);

        Event::assertDispatched(OrderPaymentSuccessful::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }

    /** @test */
    public function it_fires_the_order_payment_failed_event()
    {
        Event::fake();

        list($user, $paymentMethod, $order, $event) = $this->createEvent();

        list($gateway, $customer) = $this->mockFlow();

        $customer->shouldReceive('charge')
            ->with(
                $order->paymentMethod,
                $order->total()->getAmount()
            )
            ->andThrow(PaymentFailedException::class);

        $listener = new ProcessPayment($gateway);
        $listener->handle($event);

        Event::assertDispatched(OrderPaymentFailed::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }

    /**
     * Create the necessary dependencies for an OrderCreated event.
     *
     * @return array
     */
    protected function createEvent()
    {
        $user = factory(User::class)->create();

        $paymentMethod = factory(PaymentMethod::class)->create();
        
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethod->id
        ]);

        $event = new OrderCreated($order);

        return [$user, $paymentMethod, $order, $event];
    }

    /**
     * Mock the payment process flow.
     *
     * @return array
     */
    protected function mockFlow()
    {
        $gateway = Mockery::mock(StripePaymentGateway::class);
        $gateway->shouldReceive('withUser')
            ->andReturn($gateway)
            ->shouldReceive('getCustomer')
            ->andReturn(
                $customer = Mockery::mock(StripeGatewayCustomer::class)
            );

        return [$gateway, $customer];
    }
}
