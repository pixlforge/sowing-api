<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;

class PaymentMethodIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('payment-methods.index'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_returns_a_collection_of_payment_methods()
    {
        $user = factory(User::class)->create();

        $paymentMethod = factory(PaymentMethod::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJsonAs($user, route('payment-methods.index'));

        $response->assertJsonFragment([
            'id' => $paymentMethod->id
        ]);
    }
}
