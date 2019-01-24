<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\Shop;

class ShopShowTest extends TestCase
{
    /** @test */
    public function it_fails_if_the_shop_cannot_be_found()
    {
        $response = $this->getJson(route('shops.show', 'nope'));

        $response->assertNotFound();
    }
    
    /** @test */
    public function it_can_get_a_single_shop()
    {
        $shop = factory(Shop::class)->create();

        $response = $this->getJson(route('shops.show', $shop->slug));

        $response->assertJsonFragment([
            'id' => $shop->id
        ]);
    }
}
