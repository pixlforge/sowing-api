<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class ShopCheckerTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('shop.checker'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_passes_if_the_name_is_available()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('shop.checker'), [
            'name' => 'My Awesome Shop'
        ]);

        $response->assertSuccessful();
    }

    /** @test */
    public function it_fails_if_the_name_is_unavailable()
    {
        $user = factory(User::class)->create();

        factory(Shop::class)->create([
            'name' => 'My Awesome Shop'
        ]);

        $response = $this->postJsonAs($user, route('shop.checker'), [
            'name' => 'My Awesome Shop'
        ]);

        $response->assertStatus(409);
    }
}
