<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Payments\Contracts\CustomerContract;
use App\Payments\Contracts\PaymentGatewayContract;

class PaymentMethodDestroyTest extends TestCase
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
    public function it_fails_if_unauthenticated()
    {
        $response = $this->deleteJson(route('payment-methods.destroy', 1));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_payment_method_cannot_be_found()
    {
        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_payment_method_is_not_owned_by_the_user()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $paymentMethod));

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_delete_an_existing_payment_method()
    {
        $paymentGateway = $this->mock(PaymentGatewayContract::class);

        $paymentGateway->shouldReceive('withUser')
            ->andReturn($paymentGateway)
            ->shouldReceive('getOrCreateCustomer')
            ->andReturn($customer = $this->mock(CustomerContract::class));

        $customer->shouldReceive('removeCard')
            ->with($this->paymentMethod->provider_id);
        
        $this->assertNull($this->paymentMethod->deleted_at);

        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $this->paymentMethod));

        $response->assertSuccessful();

        $this->assertNotNull($this->paymentMethod->fresh()->deleted_at);
    }

    /** @test */
    public function it_sets_the_soft_deleted_payment_method_to_not_default()
    {
        $paymentGateway = $this->mock(PaymentGatewayContract::class);

        $paymentGateway->shouldReceive('withUser')
            ->andReturn($paymentGateway)
            ->shouldReceive('getOrCreateCustomer')
            ->andReturn($customer = $this->mock(CustomerContract::class));
        
        $customer->shouldReceive('removeCard')
            ->with($this->paymentMethod->provider_id);
        
        $this->assertTrue($this->paymentMethod->isDefault());

        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $this->paymentMethod));

        $response->assertSuccessful();

        $this->assertFalse($this->paymentMethod->fresh()->isDefault());
    }

    /** @test */
    public function it_sets_another_payment_method_as_default_upon_delete()
    {
        $this->user->paymentMethods()->save(
            $paymentMethod = PaymentMethod::factory()->make()
        );

        $paymentMethod->update([
            'is_default' => false
        ]);

        $this->assertTrue($this->paymentMethod->isDefault());
        $this->assertFalse($paymentMethod->isDefault());

        $paymentGateway = $this->mock(PaymentGatewayContract::class);

        $paymentGateway->shouldReceive('withUser')
            ->andReturn($paymentGateway)
            ->shouldReceive('getOrCreateCustomer')
            ->andReturn($customer = $this->mock(CustomerContract::class));
        
        $customer->shouldReceive('removeCard')
            ->with($this->paymentMethod->provider_id);

        $response = $this->deleteJsonAs($this->user, route('payment-methods.destroy', $this->paymentMethod));

        $response->assertSuccessful();

        $this->assertFalse($this->paymentMethod->fresh()->isDefault());
        $this->assertTrue($paymentMethod->fresh()->isDefault());
    }
}
