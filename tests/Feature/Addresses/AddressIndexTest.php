<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;

class AddressIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $response = $this->getJson(route('addresses.index'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_shows_addresses()
    {
        $user = factory(User::class)->create();

        $user->addresses()->save(
            $address = factory(Address::class)->create()
        );

        $response = $this->getJsonAs($user, route('addresses.index'));

        $response->assertJsonFragment([
            'id' => $address->id
        ]);
    }
}
