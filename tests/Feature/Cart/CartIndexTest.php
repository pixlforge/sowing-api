<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;
use App\Models\ShippingMethod;

class CartIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->variation = factory(Variation::class)->create();
    }

    /** @test */
    public function it_fails_is_unauthenticated()
    {
        $response = $this->getJson(route('cart.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_shows_product_variations_in_the_user_cart()
    {
        $this->user->cart()->sync($this->variation);

        $response = $this->getJsonAs($this->user, route('cart.index'));

        $response->assertJsonFragment([
            'id' => $this->variation->id
        ]);
    }

    /** @test */
    public function it_shows_if_the_cart_is_empty()
    {
        $response = $this->getJsonAs($this->user, route('cart.index'));

        $response->assertJsonFragment([
            'is_empty' => true
        ]);
    }

    /** @test */
    public function it_shows_a_raw_subtotal()
    {
        $response = $this->getJsonAs($this->user, route('cart.index'));

        $response->assertJsonFragment([
            'subtotal' => [
                'currency' => 'CHF',
                'amount' => '0.00'
            ]
        ]);
    }

    /** @test */
    public function it_shows_a_raw_total()
    {
        $response = $this->getJsonAs($this->user, route('cart.index'));

        $response->assertJsonFragment([
            'total' => [
                'currency' => 'CHF',
                'amount' => '0.00'
            ]
        ]);
    }

    /** @test */
    public function it_shows_if_the_cart_quantities_were_changed_after_syncing()
    {
        $this->user->cart()->attach($this->variation, [
            'quantity' => 1
        ]);

        $response = $this->getJsonAs($this->user, route('cart.index'));

        $response->assertJsonFragment([
            'has_changed' => true
        ]);
    }

    /** @test */
    public function it_fails_if_shipping_method_is_invalid()
    {
        $this->user->cart()->attach($this->variation, [
            'quantity' => 1
        ]);

        $response = $this->getJsonAs($this->user, route('cart.index', [
            'shipping_method_id' => 999
        ]));

        $response->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    public function it_shows_a_formatted_total_with_shipping()
    {
        $shippingMethod = factory(ShippingMethod::class)->create([
            'price' => 1000
        ]);

        $response = $this->getJsonAs($this->user, route('cart.index', [
            'shipping_method_id' => $shippingMethod->id
        ]));

        $response->assertJsonFragment([
            'total' => [
                'amount' => '10.00',
                'currency' => 'CHF'
            ]
        ]);
    }
}
