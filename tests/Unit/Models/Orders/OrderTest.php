<?php

namespace Tests\Unit\Models\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Models\Variation;

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
}
