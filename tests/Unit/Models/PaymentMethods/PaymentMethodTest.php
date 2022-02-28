<?php

namespace Tests\Unit\Models\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->paymentMethods()->save(
            $this->paymentMethod = PaymentMethod::factory()->state('default')->make()
        );
    }
    
    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->paymentMethod->user);
    }

    /** @test */
    public function it_can_check_a_payment_method_is_set_as_default()
    {
        $this->assertTrue($this->paymentMethod->isDefault());
    }

    /** @test */
    public function it_sets_old_payment_method_to_not_default_when_creating()
    {
        $this->assertTrue($this->user->paymentMethods->first()->isDefault());

        $this->user->paymentMethods()->save(
            PaymentMethod::factory()->state('default')->make()
        );

        $this->assertFalse($this->user->paymentMethods->first()->fresh()->isDefault());

        $this->assertTrue($this->user->paymentMethods->last()->isDefault());
    }
}
