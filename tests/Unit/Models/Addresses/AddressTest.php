<?php

namespace Tests\Unit\Models\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;

class AddressTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->addresses()->save(
            $this->address = factory(Address::class)->state('default')->make()
        );
    }

    /** @test */
    public function it_has_one_country()
    {
        $this->assertInstanceOf(Country::class, $this->address->country);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->address->user);
    }

    /** @test */
    public function it_can_check_an_address_is_set_as_default()
    {
        $this->assertTrue($this->address->isDefault());
    }
    
    /** @test */
    public function it_unsets_old_addresses_as_default_upon_creation()
    {
        $this->user->addresses()->save(
            factory(Address::class)->states('default')->make()
        );

        $this->assertFalse($this->address->fresh()->isDefault());
    }
}
