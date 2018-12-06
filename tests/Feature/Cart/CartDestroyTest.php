<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;

class CartDestroyTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->deleteJson(route('cart.destroy', 1));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $user = factory(User::class)->create();

        $response = $this->deleteJsonAs($user, route('cart.destroy', 999));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_removes_the_product_variation_from_the_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 5]
        );

        $this->assertCount(1, $user->fresh()->cart);

        $this->deleteJsonAs($user, route('cart.destroy', $variation->id));

        $this->assertCount(0, $user->fresh()->cart);
        $this->assertDatabaseMissing('cart_user', [
            'user_id' => $user->id,
            'variation_id' => $variation->id,
            'quantity' => 5
        ]);
    }
}
