<?php

namespace Tests\Unit\Models\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\ShippingMethod;

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
}
