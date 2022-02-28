<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Http\Resources\ShippingMethods\ShippingMethodResource;

class AddressShippingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();

        $this->user->addresses()->save(
            $this->address = Address::factory()->make()
        );

        $this->address->country->shippingMethods()->attach(
            ShippingMethod::factory()->create()
        );
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('addresses.shipping', $this->address));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_an_address_cannot_be_found()
    {
        $response = $this->getJsonAs($this->user, route('addresses.shipping', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_address()
    {
        $address = Address::factory()->create();

        $response = $this->getJsonAs($this->user, route('addresses.shipping', $address));

        $response->assertForbidden();
    }

    /** @test */
    public function it_shows_shipping_methods_for_the_given_address()
    {
        $response = $this->getJsonAs($this->user, route('addresses.shipping', $this->address));

        $response->assertResource(ShippingMethodResource::collection($this->address->country->shippingMethods));
    }
}
