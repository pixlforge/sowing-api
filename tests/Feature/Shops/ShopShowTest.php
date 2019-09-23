<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\Shop;
use App\Http\Resources\Shops\ShopResource;

class ShopShowTest extends TestCase
{
    /** @test */
    public function it_fails_if_the_shop_cannot_be_found()
    {
        $response = $this->getJson(route('shops.show', 'nope'));

        $response->assertNotFound();
    }
    
    /** @test */
    public function it_returns_a_shop_resource()
    {
        $shop = factory(Shop::class)->create();

        $response = $this->getJson(route('shops.show', $shop->slug));

        $response->assertResource(ShopResource::make($shop));
    }
}
