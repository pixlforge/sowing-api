<?php

namespace Tests\Unit\Models\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Money\Money;
use App\Models\Order;
use App\Models\Address;
use App\Models\Variation;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;

class OrderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->orders()->save(
            $this->order = factory(Order::class)->create()
        );
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->order->user);
    }

    /** @test */
    public function it_belongs_to_an_address()
    {
        $this->assertInstanceOf(Address::class, $this->order->address);
    }

    /** @test */
    public function it_belongs_to_a_shipping_method()
    {
        $this->assertInstanceOf(ShippingMethod::class, $this->order->shippingMethod);
    }

    /** @test */
    public function it_belongs_to_a_payment_method()
    {
        $this->assertInstanceOf(PaymentMethod::class, $this->order->paymentMethod);
    }

    /** @test */
    public function it_has_many_transactions()
    {
        $this->order->transactions()->save(
            factory(Transaction::class)->make()
        );

        $this->assertInstanceOf(Transaction::class, $this->order->transactions->first());
    }

    /** @test */
    public function it_has_a_default_status_of_pending()
    {
        $this->assertEquals(Order::PENDING, $this->order->status);
    }

    /** @test */
    public function it_has_many_product_variations()
    {
        $this->order->variations()->attach(
            factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $this->assertInstanceOf(Variation::class, $this->order->variations->first());
    }

    /** @test */
    public function it_has_a_quantity_attached_to_the_product_variations()
    {
        $this->order->variations()->attach(
            factory(Variation::class)->create(),
            ['quantity' => $quantity = 5]
        );

        $this->assertEquals($quantity, $this->order->variations->first()->pivot->quantity);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_subtotal()
    {
        $this->assertInstanceOf(Money::class, $this->order->subtotal);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_total()
    {
        $this->assertInstanceOf(Money::class, $this->order->total());
    }

    /** @test */
    public function it_adds_shipping_onto_the_total()
    {
        $order = factory(Order::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            },
            'subtotal' => 1000,
            'shipping_method_id' => function () {
                return factory(ShippingMethod::class)->create([
                    'price' => 800
                ])->id;
            }
        ]);

        $this->assertEquals(1800, $order->total()->getAmount());
    }
}
