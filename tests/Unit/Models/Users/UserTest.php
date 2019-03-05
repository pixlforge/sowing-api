<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;
use App\Models\Address;
use App\Models\Order;
use App\Models\Shop;
use App\Models\PaymentMethod;

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

    /** @test */
    public function it_has_many_addresses()
    {
        $user = factory(User::class)->create();

        $user->addresses()->save(
            factory(Address::class)->make()
        );

        $this->assertInstanceOf(Address::class, $user->addresses->first());
    }

    /** @test */
    public function it_has_many_orders()
    {
        $user = factory(User::class)->create();

        factory(Order::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(Order::class, $user->orders->first());
    }

    /** @test */
    public function it_has_one_shop()
    {
        $user = factory(User::class)->create();

        factory(Shop::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(Shop::class, $user->shop);
    }
    
    /** @test */
    public function it_can_check_if_the_user_has_a_shop()
    {
        $user = factory(User::class)->create();

        factory(Shop::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertTrue($user->hasShop());
    }

    /** @test */
    public function it_has_many_payment_methods()
    {
        $user = factory(User::class)->create();

        factory(PaymentMethod::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(PaymentMethod::class, $user->paymentMethods->first());
    }

    /** @test */
    public function it_can_get_the_users_confirmation_token()
    {
        $user = factory(User::class)->create();

        $user->confirmation_token = User::generateConfirmationToken($user->email);

        $this->assertNotNull($user->getConfirmationToken());
    }
}
