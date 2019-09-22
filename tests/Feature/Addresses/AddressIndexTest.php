<?php

namespace Tests\Feature\Addresses;

use App\Http\Resources\Addresses\AddressResource;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;

class AddressIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
    }
    
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $response = $this->getJson(route('addresses.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_shows_addresses()
    {
        $this->user->addresses()->save(
            $address = factory(Address::class)->make()
        );

        $response = $this->getJsonAs($this->user, route('addresses.index'));

        $response->assertJsonFragment([
            'id' => $address->id,
            'first_name' => $address->first_name
        ]);
    }

    /** @test */
    public function it_returns_an_address_resource()
    {
        $this->user->addresses()->save(
            factory(Address::class)->make()
        );

        $response = $this->getJsonAs($this->user, route('addresses.index'));

        $response->assertResource(AddressResource::collection($this->user->addresses));
    }
}
