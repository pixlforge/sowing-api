<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProductVariation;

class CartUpdateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        
        $this->variation = factory(ProductVariation::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('cart.update', 1));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $response = $this->patchJsonAs($this->user, route('cart.update', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_quantity()
    {
        $response = $this->patchJsonAs($this->user, route('cart.update', $this->variation->id), []);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_numeric_quantity()
    {
        $response = $this->patchJsonAs($this->user, route('cart.update', $this->variation->id), [
            'quantity' => 'five'
        ]);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_quantity_of_at_least_one()
    {
        $response = $this->patchJsonAs($this->user, route('cart.update', $this->variation->id), [
            'quantity' => 0
        ]);

        $response->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_can_update_a_product_variation_quantity()
    {
        $this->user->cart()->attach($this->variation, [
            'quantity' => 1
        ]);

        $this->patchJsonAs($this->user, route('cart.update', $this->variation->id), [
            'quantity' => 5
        ]);

        $this->assertDatabaseHas('cart_user', [
            'user_id' => $this->user->id,
            'product_variation_id' => $this->variation->id,
            'quantity' => 5,
        ]);
    }
}
