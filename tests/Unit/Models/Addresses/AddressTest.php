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
}
