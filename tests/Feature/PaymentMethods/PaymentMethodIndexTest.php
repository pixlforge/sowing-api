<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;

class PaymentMethodIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('payment-methods.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_a_collection_of_payment_methods()
    {
        $this->user->paymentMethods()->save(
            PaymentMethod::factory()->make()
        );

        $response = $this->getJsonAs($this->user, route('payment-methods.index'));

        $response->assertResource(PaymentMethodResource::collection($this->user->paymentMethods));
    }
}
