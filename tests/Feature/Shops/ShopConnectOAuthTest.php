<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class ShopConnectOAuthTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('shops.connect'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_a_shop()
    {
        $user = factory(User::class)->create();
        
        $response = $this->postJsonAs($user, route('shops.connect'));

        $response->assertForbidden();
    }

    /** @test */
    public function it_fails_if_stripe_code_is_missing()
    {
        $user = factory(User::class)->create();

        $user->shop()->save(
            factory(Shop::class)->create()
        );
        
        $response = $this->postJsonAs($user, route('shops.connect'));

        $response->assertStatus(400);
    }
}
