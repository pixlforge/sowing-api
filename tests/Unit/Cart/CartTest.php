<?php

namespace Tests\Unit\Cart;

use Tests\TestCase;
use App\Cart\Cart;
use App\Models\User;
use App\Models\Variation;

class CartTest extends TestCase
{
    /** @test */
    public function it_can_add_products_to_the_cart()
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
}
