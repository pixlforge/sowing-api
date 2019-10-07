<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodUpdateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->paymentMethods()->save(
            $this->paymentMethod = factory(PaymentMethod::class)->make()
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('payment-methods.update', $this->paymentMethod));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_payment_method_cannot_be_found()
    {
        $response = $this->patchJsonAs($this->user, route('payment-methods.update', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_payment_method_does_not_belong_to_the_user()
    {
        $paymentMethod = factory(PaymentMethod::class)->create();

        $response = $this->patchJsonAs($this->user, route('payment-methods.update', $paymentMethod));

        $response->assertForbidden();
    }

    /** @test */
    public function it_sets_the_payment_method_as_default()
    {
        $this->user->paymentMethods()->save(
            $otherPaymentMethod = factory(PaymentMethod::class)->state('default')->make()
        );

        $this->assertFalse($this->paymentMethod->fresh()->isDefault());
        $this->assertTrue($otherPaymentMethod->fresh()->isDefault());

        $response = $this->patchJsonAs($this->user, route('payment-methods.update', $this->paymentMethod));

        $response->assertStatus(204);

        $this->assertTrue($this->paymentMethod->fresh()->isDefault());
        $this->assertFalse($otherPaymentMethod->fresh()->isDefault());
    }
}
