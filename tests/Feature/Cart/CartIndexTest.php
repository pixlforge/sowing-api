<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;

class CartIndexTest extends TestCase
{
    /** @test */
    public function it_fails_is_unauthenticated()
    {
        $response = $this->getJson(route('cart.index'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_shows_product_variations_in_the_user_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $variation = factory(Variation::class)->create()
        );

        $response = $this->getJsonAs($user, route('cart.index'));
        $response->assertJsonFragment([
            'id' => $variation->id
        ]);
    }
}
