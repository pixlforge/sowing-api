<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;

class CartUpdateTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('cart.update', 1));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $user = factory(User::class)->create();

        $response = $this->patchJsonAs($user, route('cart.update', 999));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_requires_a_quantity()
    {
        $user = factory(User::class)->create();

        $variation = factory(Variation::class)->create();

        $response = $this->patchJsonAs($user, route('cart.update', "$variation->id"), []);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_numeric_quantity()
    {
        $user = factory(User::class)->create();

        $variation = factory(Variation::class)->create();

        $response = $this->patchJsonAs($user, route('cart.update', "$variation->id"), [
            'quantity' => 'five'
        ]);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_quantity_of_at_least_one()
    {
        $user = factory(User::class)->create();

        $variation = factory(Variation::class)->create();

        $response = $this->patchJsonAs($user, route('cart.update', "$variation->id"), [
            'quantity' => 0
        ]);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_can_update_a_product_variation_quantity()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $response = $this->patchJsonAs($user, route('cart.update', "$variation->id"), [
            'quantity' => 5
        ]);

        $this->assertDatabaseHas('cart_user', [
            'user_id' => $user->id,
            'variation_id' => $variation->id,
            'quantity' => 5,
        ]);
    }
}
