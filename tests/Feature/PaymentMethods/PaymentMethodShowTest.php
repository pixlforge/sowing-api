<?php

namespace Tests\Feature\PaymentMethods;

use App\Http\Resources\PaymentMethods\PaymentMethodResource;
use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodShowTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->paymentMethods()->save(
            $this->paymentMethod = PaymentMethod::factory()->make()
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('payment-methods.show', $this->paymentMethod));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_payment_method_cannot_be_found()
    {
        $response = $this->getJsonAs($this->user, route('payment-methods.show', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_payment_methods_is_not_owned_by_the_current_authenticated_user()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $response = $this->getJsonAs($this->user, route('payment-methods.show', $paymentMethod));

        $response->assertForbidden();
    }

    /** @test */
    public function it_returns_a_payment_method_resource()
    {
        $response = $this->getJsonAs($this->user, route('payment-methods.show', $this->paymentMethod));

        $response->assertResource(PaymentMethodResource::make($this->user->paymentMethods->first()));
    }
}
