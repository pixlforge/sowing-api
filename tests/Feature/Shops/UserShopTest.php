<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Http\Resources\Shops\UserShopResource;

class UserShopTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('user.shop'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_a_user_shop_resource()
    {
        $user = User::factory()->create();

        $user->shop()->save(
            Shop::factory()->make()
        );

        $response = $this->getJsonAs($user, route('user.shop'));

        $response->assertResource(UserShopResource::make($user->shop));
    }
}
