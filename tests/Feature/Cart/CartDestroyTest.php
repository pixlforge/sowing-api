<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProductVariation;

class CartDestroyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->deleteJson(route('cart.destroy', 1));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $response = $this->deleteJsonAs($this->user, route('cart.destroy', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_removes_the_product_variation_from_the_cart()
    {
        $this->user->cart()->sync(
            $variation = ProductVariation::factory()->create(), [
                'quantity' => 5
            ]
        );

        $this->assertCount(1, $this->user->fresh()->cart);

        $this->deleteJsonAs($this->user, route('cart.destroy', $variation->id));

        $this->assertCount(0, $this->user->fresh()->cart);

        $this->assertDatabaseMissing('cart_user', [
            'user_id' => $this->user->id,
            'product_variation_id' => $variation->id,
            'quantity' => 5
        ]);
    }
}
