<?php

namespace Tests\Unit\Cart;

use App\Cart\Cart;
use Tests\TestCase;
use App\Money\Money;
use App\Models\User;
use App\Models\ShippingMethod;
use App\Models\ProductVariation;

class CartTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->cart = new Cart(
            $this->user = User::factory()->create()
        );

        $this->variation = ProductVariation::factory()->create();
    }

    /** @test */
    public function it_can_add_product_variations_to_the_cart()
    {
        $this->cart->add([
            ['id' => $this->variation->id, 'quantity' => 5]
        ]);

        $this->assertCount(1, $this->user->fresh()->cart);
    }

    /** @test */
    public function it_increments_quantity_when_adding_more_product_variations()
    {
        $this->cart->add([
            ['id' => $this->variation->id, 'quantity' => 5]
        ]);

        // Second request
        $this->cart = new Cart($this->user->fresh());

        $this->cart->add([
            ['id' => $this->variation->id, 'quantity' => 5]
        ]);

        $this->assertEquals(10, $this->user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_can_update_quantities_in_the_cart()
    {
        $this->user->cart()->attach(
            $this->variation,
            ['quantity' => 1]
        );

        $this->cart->update($this->variation->id, 5);

        $this->assertEquals(5, $this->user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_can_delete_a_product_variation_from_the_cart()
    {
        $this->user->cart()->attach(
            $this->variation,
            ['quantity' => 1]
        );

        $this->cart->delete($this->variation->id);

        $this->assertCount(0, $this->user->fresh()->cart);
    }

    /** @test */
    public function it_can_empty_all_product_variations_from_the_cart()
    {
        $this->user->cart()->attach(
            $this->variation,
            ['quantity' => 1]
        );

        $this->user->cart()->attach(
            ProductVariation::factory()->create(),
            ['quantity' => 1]
        );

        $this->assertCount(2, $this->user->fresh()->cart);

        $this->cart->empty();

        $this->assertCount(0, $this->user->fresh()->cart);
    }

    /** @test */
    public function it_can_check_if_the_cart_is_empty()
    {
        $this->user->cart()->attach(
            $this->variation,
            ['quantity' => 0]
        );

        $this->assertTrue($this->cart->isEmpty());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_subtotal()
    {
        $this->assertInstanceOf(Money::class, $this->cart->subtotal());
    }

    /** @test */
    public function it_returns_the_correct_amount_for_the_cart_subtotal()
    {
        $this->user->cart()->attach(
            ProductVariation::factory()->create([
                'price' => 1000
            ]),
            ['quantity' => 2]
        );

        $this->assertEquals(2000, $this->cart->subtotal()->getAmount());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_total()
    {
        $this->assertInstanceOf(Money::class, $this->cart->total());
    }

    /** @test */
    public function it_returns_the_correct_total_without_shipping()
    {
        $this->user->cart()->attach(
            ProductVariation::factory()->create([
                'price' => 1000
            ]),
            ['quantity' => 2]
        );

        $this->assertEquals(2000, $this->cart->total()->getAmount());
    }

    /** @test */
    public function it_returns_the_correct_total_with_shipping()
    {
        $shippingMethod = ShippingMethod::factory()->create([
            'price' => 1000
        ]);

        $this->user->cart()->attach(
            ProductVariation::factory()->create([
                'price' => 1000
            ]),
            ['quantity' => 2]
        );

        $this->cart->withShipping($shippingMethod->id);

        $this->assertEquals(3000, $this->cart->total()->getAmount());
    }

    /** @test */
    public function it_syncs_the_cart_to_update_quantities()
    {
        $anotherVariation = ProductVariation::factory()->create();

        $this->user->cart()->attach([
            $this->variation->id => [
                'quantity' => 2
            ],
            $anotherVariation->id => [
                'quantity' => 2
            ]
        ]);

        $this->cart->sync();

        $this->assertEquals(0, $this->user->fresh()->cart->first()->pivot->quantity);

        $this->assertEquals(0, $this->user->cart->get(1)->pivot->quantity);
    }

    /** @test */
    public function it_can_check_the_cart_has_been_changed_after_syncing()
    {
        $anotherVariation = ProductVariation::factory()->create();

        $this->user->cart()->attach([
            $this->variation->id => [
                'quantity' => 2
            ],
            $anotherVariation->id => [
                'quantity' => 0
            ]
        ]);

        $this->cart->sync();

        $this->assertTrue($this->cart->hasChanged());
    }

    /** @test */
    public function it_can_check_the_cart_has_not_been_changed_after_syncing_if_it_does_not_need_to()
    {
        $this->cart->sync();

        $this->assertFalse($this->cart->hasChanged());
    }

    /** @test */
    public function it_returns_product_variations_in_cart()
    {
        $this->user->cart()->attach(
            ProductVariation::factory()->create([
                'price' => 1000
            ]),
            ['quantity' => 1]
        );

        $this->assertInstanceOf(ProductVariation::class, $this->cart->variations()->first());
    }
}
