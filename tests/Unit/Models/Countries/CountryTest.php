<?php

namespace Tests\Unit\Models\Countries;

use Tests\TestCase;
use App\Models\Country;
use App\Models\ShippingMethod;
use App\Models\Shop;

class CountryTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_shipping_methods()
    {
        $country = factory(Country::class)->create();

        $country->shippingMethods()->attach(
            factory(ShippingMethod::class)->create()
        );

        $this->assertInstanceOf(ShippingMethod::class, $country->shippingMethods->first());
    }

    /** @test */
    public function it_has_many_shops()
    {
        $country = factory(Country::class)->create();

        factory(Shop::class)->create([
            'country_id' => $country->id
        ]);

        $this->assertInstanceOf(Shop::class, $country->shops->first());
    }
}
