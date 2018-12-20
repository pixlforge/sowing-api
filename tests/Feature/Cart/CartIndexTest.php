<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;
use App\Models\ShippingMethod;

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

    /** @test */
    public function it_shows_if_the_cart_is_empty()
    {
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('cart.index'));

        $response->assertJsonFragment([
            'is_empty' => true
        ]);
    }

    /** @test */
    public function it_shows_a_raw_subtotal()
    {
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('cart.index'));

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
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('cart.index'));

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
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $response = $this->getJsonAs($user, route('cart.index'));

        $response->assertJsonFragment([
            'has_changed' => true
        ]);
    }

    /** @test */
    public function it_fails_if_shipping_method_is_invalid()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $response = $this->getJsonAs($user, route('cart.index', ['shipping_method_id' => 999]));

        $response->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    public function it_shows_a_formatted_total_with_shipping()
    {
        $user = factory(User::class)->create();

        $shippingMethod = factory(ShippingMethod::class)->create([
            'price' => 1000
        ]);

        $response = $this->getJsonAs($user, route('cart.index', ['shipping_method_id' => $shippingMethod->id]));

        $response->assertJsonFragment([
            'total' => [
                'amount' => '10.00',
                'currency' => 'CHF'
            ]
        ]);
    }
}
