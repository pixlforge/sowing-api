<?php

namespace Tests\Unit\Models\Addresses;

use Tests\TestCase;
use App\Models\Address;
use App\Models\Country;
use App\Models\User;

class AddressTest extends TestCase
{
    /** @test */
    public function it_has_one_country()
    {
        $address = factory(Address::class)->create();

        $this->assertInstanceOf(Country::class, $address->country);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $address = factory(Address::class)->create();

        $this->assertInstanceOf(User::class, $address->user);
    }

    /** @test */
    public function it_can_check_an_address_is_set_as_default()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->states('default')->create();

        $this->assertTrue($address->isDefault());
    }
    
    /** @test */
    public function it_unsets_old_addresses_as_default_upon_creation()
    {
        $user = factory(User::class)->create();

        $oldAddress = factory(Address::class)->states('default')->create([
            'user_id' => $user->id
        ]);

        factory(Address::class)->states('default')->create([
            'user_id' => $user->id
        ]);

        $this->assertFalse($oldAddress->fresh()->isDefault());
    }
}
