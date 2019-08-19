<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;

class CartStoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('cart.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_product_variations()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'));

        $response->assertJsonValidationErrors(['variations']);
    }

    /** @test */
    public function it_requires_variations_to_be_an_array()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => 1
        ]);

        $response->assertJsonValidationErrors(['variations']);
    }

    /** @test */
    public function it_requires_variations_to_have_an_id()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => [
                ['quantity' => 5]
            ]
        ]);

        $response->assertJsonValidationErrors(['variations.0.id']);
    }

    /** @test */
    public function it_requires_variations_to_exist()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => [
                ['id' => 999, 'quantity' => 5]
            ]
        ]);

        $response->assertJsonValidationErrors(['variations.0.id']);
    }

    /** @test */
    public function it_requires_quantity_to_be_numeric()
    {
        $variation = factory(Variation::class)->create();

        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => [
                ['id' => $variation->id, 'quantity' => 'one']
            ]
        ]);

        $response->assertJsonValidationErrors(['variations.0.quantity']);
    }

    /** @test */
    public function it_requires_quantity_to_be_at_least_one()
    {
        $variation = factory(Variation::class)->create();

        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => [
                ['id' => $variation->id, 'quantity' => 0]
            ]
        ]);

        $response->assertJsonValidationErrors(['variations.0.quantity']);
    }

    /** @test */
    public function it_can_add_product_variations_to_the_users_cart()
    {
        $variation = factory(Variation::class)->create();

        $this->postJsonAs($this->user, route('cart.store'), [
            'variations' => [
                ['id' => $variation->id, 'quantity' => 2]
            ]
        ]);

        $this->assertDatabaseHas('cart_user', [
            'user_id' => $this->user->id,
            'variation_id' => $variation->id,
            'quantity' => 2,
        ]);
    }
}
