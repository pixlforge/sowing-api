<?php

namespace Tests\Unit\Models\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Models\Variation;
use App\Money\Money;
use App\Models\PaymentMethod;

class OrderTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(User::class, $order->user);
    }

    /** @test */
    public function it_belongs_to_an_address()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(Address::class, $order->address);
    }

    /** @test */
    public function it_belongs_to_a_shipping_method()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(ShippingMethod::class, $order->shippingMethod);
    }

    /** @test */
    public function it_belongs_to_a_payment_method()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(PaymentMethod::class, $order->paymentMethod);
    }

    /** @test */
    public function it_has_a_default_status_of_pending()
    {
        $order = factory(Order::class)->create();

        $this->assertEquals(Order::PENDING, $order->status);
    }

    /** @test */
    public function it_has_many_product_variations()
    {
        $order = factory(Order::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $order->variations()->attach(
            factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $this->assertInstanceOf(Variation::class, $order->variations->first());
    }

    /** @test */
    public function it_has_a_quantity_attached_to_the_product_variations()
    {
        $order = factory(Order::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $order->variations()->attach(
            factory(Variation::class)->create(),
            ['quantity' => $quantity = 5]
        );

        $this->assertEquals($quantity, $order->variations->first()->pivot->quantity);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_subtotal()
    {
        $order = factory(Order::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $this->assertInstanceOf(Money::class, $order->subtotal);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_total()
    {
        $order = factory(Order::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $this->assertInstanceOf(Money::class, $order->total());
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

        $this->assertEquals(1800, $order->total()->amount());
    }
}
