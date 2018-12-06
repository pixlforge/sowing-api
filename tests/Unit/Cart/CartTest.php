<?php

namespace Tests\Unit\Cart;

use Tests\TestCase;
use App\Cart\Cart;
use App\Models\User;
use App\Models\Variation;

class CartTest extends TestCase
{
    /** @test */
    public function it_can_add_product_variations_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $variation = factory(Variation::class)->create();

        $cart->add([
            ['id' => $variation->id, 'quantity' => 5]
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }

    /** @test */
    public function it_increments_quantity_when_adding_more_product_variations()
    {
        $variation = factory(Variation::class)->create();

        // First request
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->add([
            ['id' => $variation->id, 'quantity' => 5]
        ]);

        // Second request
        $cart = new Cart($user->fresh());

        $cart->add([
            ['id' => $variation->id, 'quantity' => 5]
        ]);

        $this->assertEquals(10, $user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $cart->update($variation->id, 5);

        $this->assertEquals(5, $user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_can_delete_a_product_variation_from_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $cart->delete($variation->id);

        $this->assertCount(0, $user->fresh()->cart);
    }
}
