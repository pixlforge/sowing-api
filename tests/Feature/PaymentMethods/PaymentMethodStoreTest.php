<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;

/**
 * @group Stripe
 */
class PaymentMethodStoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('payment-methods.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_token()
    {
        $response = $this->postJsonAs($this->user, route('payment-methods.store'));

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_can_successfully_add_a_card()
    {
        $response = $this->postJsonAs($this->user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
        
        $response->assertSuccessful();

        $this->assertDatabaseHas('payment_methods', [
            'user_id' => $this->user->id,
            'card_type' => 'Visa',
            'last_four' => '4242'
        ]);
    }

    /** @test */
    public function it_returns_the_created_card()
    {
        $response = $this->postJsonAs($this->user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
        
        $response->assertSuccessful();

        $response->assertResource(PaymentMethodResource::make($this->user->paymentMethods->first()));
    }

    /** @test */
    public function it_sets_the_created_card_as_default()
    {
        $response = $this->postJsonAs($this->user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
     
        $response->assertSuccessful();

        $this->assertTrue($this->user->paymentMethods->first()->isDefault());
    }
}
