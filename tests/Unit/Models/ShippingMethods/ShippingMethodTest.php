<?php

namespace Tests\Unit\Models\ShippingMethods;

use Tests\TestCase;
use App\Money\Money;
use App\Models\Order;
use App\Models\Country;
use App\Models\ShippingMethod;

class ShippingMethodTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->shippingMethod = ShippingMethod::factory()->create();
    }
    
    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $this->assertInstanceOf(Money::class, $this->shippingMethod->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $this->assertEquals(
            (new Money($this->shippingMethod->price->getAmount()))->formatted(),
            $this->shippingMethod->formatted_price
        );
    }

    /** @test */
    public function it_returns_a_detailed_price()
    {
        $this->assertEquals(
            [
                'amount' => $this->shippingMethod->detailedPrice['amount'],
                'currency' => $this->shippingMethod->detailedPrice['currency']
            ],
            $this->shippingMethod->detailedPrice
        );
    }

    /** @test */
    public function it_belongs_to_many_countries()
    {
        $this->shippingMethod->countries()->attach(
            Country::factory()->create()
        );

        $this->assertInstanceOf(Country::class, $this->shippingMethod->countries->first());
    }

    /** @test */
    public function it_belongs_to_an_order()
    {
        $this->shippingMethod->orders()->save(
            Order::factory()->make()
        );

        $this->assertInstanceOf(Order::class, $this->shippingMethod->orders->first());
    }
}
