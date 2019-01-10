<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;

class PaymentMethodStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('payment-methods.store'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_a_token()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('payment-methods.store'));

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_can_successfully_add_a_card()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
        
        $response->assertSuccessful();

        $this->assertDatabaseHas('payment_methods', [
            'user_id' => $user->id,
            'card_type' => 'Visa',
            'last_four' => '4242'
        ]);
    }

    /** @test */
    public function it_returns_the_created_card()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
        
        $response->assertSuccessful();
        $response->assertJsonFragment([
            'card_type' => 'Visa'
        ]);
    }

    /** @test */
    public function it_sets_the_created_card_as_default()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('payment-methods.store'), [
            'token' => 'tok_visa'
        ]);
        
        $this->assertDatabaseHas('payment_methods', [
            'id' => $response->getData()->data->id,
            'is_default' => true
        ]);
    }
}
