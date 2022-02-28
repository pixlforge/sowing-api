<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Http\Resources\Addresses\AddressResource;

class AddressIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
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
            $address = Address::factory()->make()
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
            Address::factory()->make()
        );

        $response = $this->getJsonAs($this->user, route('addresses.index'));

        $response->assertResource(AddressResource::collection($this->user->addresses));
    }
}
