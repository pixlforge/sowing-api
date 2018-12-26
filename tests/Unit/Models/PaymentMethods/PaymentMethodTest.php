<?php

namespace Tests\Unit\Models\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $paymentMethod = factory(PaymentMethod::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $this->assertInstanceOf(User::class, $paymentMethod->user);
    }

    /** @test */
    public function it_can_check_a_payment_method_is_set_as_default()
    {
        $paymentMethod = factory(PaymentMethod::class)->states('default')->create();

        $this->assertTrue($paymentMethod->isDefault());
    }

    /** @test */
    public function it_unsets_old_payment_methods_as_default_upon_creation()
    {
        $user = factory(User::class)->create();

        $oldPaymentMethod = factory(PaymentMethod::class)->states('default')->create([
            'user_id' => $user->id
        ]);

        factory(PaymentMethod::class)->states('default')->create([
            'user_id' => $user->id
        ]);

        $this->assertFalse($oldPaymentMethod->fresh()->isDefault());
    }
}
