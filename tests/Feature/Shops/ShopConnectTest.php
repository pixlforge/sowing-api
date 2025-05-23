<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class ShopConnectTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('shops.connect'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_a_shop()
    {
        $response = $this->postJsonAs($this->user, route('shops.connect'));

        $response->assertForbidden();
    }

    /** @test */
    public function it_fails_if_stripe_code_is_missing()
    {
        $this->user->shop()->save(
            Shop::factory()->create()
        );
        
        $response = $this->postJsonAs($this->user, route('shops.connect'));

        $response->assertStatus(400);
    }
}
