<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodDestroyTest extends TestCase
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
        $response = $this->deleteJson(route('payment-methods.destroy', 1));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_payment_method_is_not_owned_by_the_user()
    {
        $paymentMethod = factory(PaymentMethod::class)->create();

        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $paymentMethod));

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_delete_an_existing_payment_method()
    {
        $this->assertNull($this->paymentMethod->deleted_at);
        
        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $this->paymentMethod));

        $response->assertSuccessful();

        $this->assertNotNull($this->paymentMethod->fresh()->deleted_at);
    }
}
