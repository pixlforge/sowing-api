<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProductVariation;

class CartStoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->variation = ProductVariation::factory()->create();
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

        $response->assertJsonValidationErrors(['product_variations']);
    }

    /** @test */
    public function it_requires_product_variations_to_be_an_array()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => 1
        ]);

        $response->assertJsonValidationErrors(['product_variations']);
    }

    /** @test */
    public function it_requires_product_variations_to_have_an_id()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => [
                ['quantity' => 5]
            ]
        ]);

        $response->assertJsonValidationErrors(['product_variations.0.id']);
    }

    /** @test */
    public function it_requires_product_variations_to_exist()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => [
                ['id' => 999]
            ]
        ]);

        $response->assertJsonValidationErrors(['product_variations.0.id']);
    }

    /** @test */
    public function it_requires_quantity_to_be_numeric()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => [
                ['id' => $this->variation->id, 'quantity' => 'one']
            ]
        ]);

        $response->assertJsonValidationErrors(['product_variations.0.quantity']);
    }

    /** @test */
    public function it_requires_quantity_to_be_at_least_one()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => [
                ['id' => $this->variation->id, 'quantity' => 0]
            ]
        ]);

        $response->assertJsonValidationErrors(['product_variations.0.quantity']);
    }

    /** @test */
    public function it_can_add_product_variations_to_the_users_cart()
    {
        $response = $this->postJsonAs($this->user, route('cart.store'), [
            'product_variations' => [
                ['id' => $this->variation->id, 'quantity' => 2]
            ]
        ]);

        $this->assertDatabaseHas('cart_user', [
            'user_id' => $this->user->id,
            'product_variation_id' => $this->variation->id,
            'quantity' => 2,
        ]);
    }
}
