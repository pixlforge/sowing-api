<?php

namespace Tests\Feature\Addresses;

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
            $address = factory(Address::class)->create()
        );

        $response = $this->getJsonAs($this->user, route('addresses.index'));

        $response->assertJsonFragment([
            'id' => $address->id
        ]);
    }
}
