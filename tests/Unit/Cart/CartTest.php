<?php

namespace Tests\Unit\Cart;

use Tests\TestCase;
use App\Cart\Cart;
use App\Models\User;
use App\Models\Variation;
use App\Money\Money;

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

    /** @test */
    public function it_can_empty_all_product_variations_from_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $this->assertCount(2, $user->fresh()->cart);

        $cart->empty();

        $this->assertCount(0, $user->fresh()->cart);
    }

    /** @test */
    public function it_can_check_if_the_cart_is_empty()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            factory(Variation::class)->create(),
            ['quantity' => 0]
        );

        $this->assertTrue($cart->isEmpty());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }

    /** @test */
    public function it_returns_the_correct_amount_for_the_cart_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            factory(Variation::class)->create([
                'price' => 1000
            ]),
            ['quantity' => 2]
        );

        $this->assertEquals(2000, $cart->subtotal()->amount());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_total()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $this->assertInstanceOf(Money::class, $cart->total());
    }

    /** @test */
    public function it_syncs_the_cart_to_update_quantities()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $cart->sync();

        $this->assertEquals(0, $user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_can_check_the_cart_has_been_changed_after_syncing()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => 1]
        );

        $cart->sync();

        $this->assertTrue($cart->hasChanged());
    }

    /** @test */
    public function it_can_check_the_cart_has_not_been_changed_after_syncing_if_it_does_not_need_to()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->sync();

        $this->assertFalse($cart->hasChanged());
    }
}
