<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class UserShopTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('user.shop'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_can_get_the_authenticated_user_shop_details()
    {
        $user = factory(User::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJsonAs($user, route('user.shop'));

        $response->assertJsonFragment([
            'id' => $shop->id
        ]);
    }
}
