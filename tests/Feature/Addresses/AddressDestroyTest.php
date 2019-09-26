<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;

class AddressDestroyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->addresses()->save(
            $this->address = factory(Address::class)->make()
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->deleteJson(route('addresses.destroy', 1));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_cannot_delete_an_address_that_does_not_belong_to_the_user()
    {
        $address = factory(Address::class)->create();

        $response = $this->deleteJsonAs($this->user, route('addresses.destroy', $address));

        $response->assertForbidden();

        $this->assertNull($address->deleted_at);
    }

    /** @test */
    public function it_can_soft_delete_an_address()
    {
        $this->assertNull($this->address->deleted_at);
        
        $response = $this->deleteJsonAs($this->user, route('addresses.destroy', $this->address));

        $response->assertSuccessful();

        $this->assertNotNull($this->address->fresh()->deleted_at);
    }
}
