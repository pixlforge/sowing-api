<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Country;

class AddressStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('addresses.store'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_a_first_name()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_last_name()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_an_address_line_1()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country_id()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_stores_an_address()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'), $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_name' => 'The Boring Company',
            'address_line_1' => 'Main Street',
            'address_line_2' => 'App 19',
            'postal_code' => '1234',
            'city' => 'Townsville',
            'country_id' => factory(Country::class)->create()->id
        ]);

        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $user->id,
        ]));
    }

    /** @test */
    public function it_returns_an_address_when_created()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('addresses.store'), [
            'first_name' => $first_name = 'John',
            'last_name' => $last_name = 'Doe',
            'company_name' => $company_name = 'The Boring Company',
            'address_line_1' => $address_line_1 = 'Main Street',
            'address_line_2' => $address_line_2 = 'App 19',
            'postal_code' => $postal_code = '1234',
            'city' => $city = 'Townsville',
            'country_id' => factory(Country::class)->create()->id
        ]);

        $response->assertJsonFragment([
            'id' => $response->getData()->data->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'company_name' => $company_name,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'postal_code' => $postal_code,
            'city' => $city,
        ]);
    }
}
