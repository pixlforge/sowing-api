<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\ShippingMethod;

class AddressShippingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('addresses.shipping', 1));

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
        $anotherUser = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => $anotherUser->id
        ]);

        $response = $this->getJsonAs($this->user, route('addresses.shipping', $address->id));

        $response->assertForbidden();
    }

    /** @test */
    public function it_shows_shipping_methods_for_the_given_address()
    {
        $this->user->addresses()->save(
            $address = factory(Address::class)->create([
                'country_id' => ($country = factory(Country::class)->create())->id
            ])
        );

        $country->shippingMethods()->attach(
            $shippingMethod = factory(ShippingMethod::class)->create()
        );

        $response = $this->getJsonAs($this->user, route('addresses.shipping', $address->id));

        $response->assertJsonFragment([
            'id' => $shippingMethod->id
        ]);
    }
}
