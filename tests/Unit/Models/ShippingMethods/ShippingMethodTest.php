<?php

namespace Tests\Unit\Models\ShippingMethods;

use Tests\TestCase;
use App\Money\Money;
use App\Models\ShippingMethod;
use App\Models\Country;

class ShippingMethodTest extends TestCase
{
    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $shippingMethod = factory(ShippingMethod::class)->create();

        $this->assertInstanceOf(Money::class, $shippingMethod->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $shippingMethod = factory(ShippingMethod::class)->create([
            'price' => 1000
        ]);

        $this->assertEquals('CHF10.00', $shippingMethod->formatted_price);
    }

    /** @test */
    public function it_returns_a_raw_price()
    {
        $shippingMethod = factory(ShippingMethod::class)->create([
            'price' => 1000
        ]);

        $this->assertEquals(['amount' => '10.00', 'currency' => 'CHF'], $shippingMethod->raw_price);
    }

    /** @test */
    public function it_belongs_to_many_countries()
    {
        $shippingMethod = factory(ShippingMethod::class)->create();

        $shippingMethod->countries()->attach(
            $country = factory(Country::class)->create()
        );

        $this->assertInstanceOf(Country::class, $shippingMethod->countries->first());
    }
}
