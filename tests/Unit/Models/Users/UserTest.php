<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_passwords_when_creating()
    {
        $user = factory(User::class)->create([
            'password' => 'secret',
        ]);

        $this->assertNotEquals('secret', $user->password);
    }

    /** @test */
    public function it_has_many_cart_product_variations()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            factory(Variation::class)->create()
        );

        $this->assertInstanceOf(Variation::class, $user->cart->first());
    }

    /** @test */
    public function it_has_a_quantity_for_each_cart_product_variation()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            factory(Variation::class)->create(),
            ['quantity' => $quantity = 5]
        );

        $this->assertEquals($quantity, $user->cart->first()->pivot->quantity);
    }
}
