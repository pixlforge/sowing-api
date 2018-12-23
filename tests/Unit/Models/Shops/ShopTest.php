<?php

namespace Tests\Unit\Models\Shops;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;

class ShopTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $shop = factory(Shop::class)->create();

        $this->assertInstanceOf(User::class, $shop->user);
    }

    /** @test */
    public function it_belongs_to_a_country()
    {
        $shop = factory(Shop::class)->create();

        $this->assertInstanceOf(Country::class, $shop->country);
    }
}
