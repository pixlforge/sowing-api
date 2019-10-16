<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'password' => $this->password = 'password'
        ]);
    }
    
    /** @test */
    public function it_hashes_passwords_when_creating()
    {
        $this->assertTrue(Hash::check($this->password, $this->user->password));
    }

    /** @test */
    public function it_has_many_cart_product_variations()
    {
        $this->user->cart()->attach(
            factory(ProductVariation::class)->create()
        );

        $this->assertInstanceOf(ProductVariation::class, $this->user->cart->first());
    }

    /** @test */
    public function it_has_a_quantity_for_each_cart_product_variation()
    {
        $this->user->cart()->attach(
            factory(ProductVariation::class)->create(),
            ['quantity' => $quantity = 5]
        );

        $this->assertEquals($quantity, $this->user->cart->first()->pivot->quantity);
    }

    /** @test */
    public function it_has_many_addresses()
    {
        $this->user->addresses()->save(
            factory(Address::class)->make()
        );

        $this->assertInstanceOf(Address::class, $this->user->addresses->first());
    }

    /** @test */
    public function it_has_many_orders()
    {
        $this->user->orders()->save(
            factory(Order::class)->make()
        );

        $this->assertInstanceOf(Order::class, $this->user->orders->first());
    }

    /** @test */
    public function it_has_one_shop()
    {
        $this->user->shop()->save(
            factory(Shop::class)->make()
        );

        $this->assertInstanceOf(Shop::class, $this->user->shop);
    }
    
    /** @test */
    public function it_can_check_if_the_user_has_a_shop()
    {
        $this->user->shop()->save(
            factory(Shop::class)->make()
        );

        $this->assertTrue($this->user->hasShop());
    }

    /** @test */
    public function it_has_many_payment_methods()
    {
        $this->user->paymentMethods()->save(
            factory(PaymentMethod::class)->make()
        );

        $this->assertInstanceOf(PaymentMethod::class, $this->user->paymentMethods->first());
    }

    /** @test */
    public function it_can_get_the_users_confirmation_token()
    {
        $this->user->confirmation_token = User::generateConfirmationToken($this->user->email);

        $this->assertNotNull($this->user->getConfirmationToken());
    }

    /** @test */
    public function it_returns_false_when_the_user_is_not_verified()
    {
        $this->user->update([
            'email_verified_at' => null
        ]);

        $this->assertFalse($this->user->isVerified());
    }

    /** @test */
    public function is_returns_true_when_the_user_is_verified()
    {
        $this->user->update([
            'email_verified_at' => now()
        ]);

        $this->assertTrue($this->user->isVerified());
    }
}
