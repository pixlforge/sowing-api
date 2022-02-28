<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Http\Resources\Addresses\AddressResource;

class AddressShowTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->addresses()->save(
            $this->address = Address::factory()->create()
        );
    }

    /** @test */
    public function it_fails_when_unauthenticated()
    {
        $response = $this->getJson(route('addresses.show', $this->address));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_it_cannot_be_found()
    {
        $response = $this->getJsonAs($this->user, route('addresses.show', 999));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_address_does_not_belong_to_the_currently_authenticated_user()
    {
        $address = Address::factory()->create();

        $response = $this->getJsonAs($this->user, route('addresses.show', $address));

        $response->assertForbidden();
    }

    /** @test */
    public function it_returns_an_address_resource()
    {
        $response = $this->getJsonAs($this->user, route('addresses.show', $this->address));

        $response->assertOk();

        $response->assertResource(AddressResource::make($this->address));
    }
}
