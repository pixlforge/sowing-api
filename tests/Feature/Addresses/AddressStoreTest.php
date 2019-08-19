<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Country;
use Illuminate\Foundation\Testing\WithFaker;

class AddressStoreTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('addresses.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_first_name()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_last_name()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_an_address_line_1()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country_id()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_stores_an_address()
    {
        $this->postJsonAs($this->user, route('addresses.store'), $payload = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => factory(Country::class)->create()->id
        ]);

        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $this->user->id,
        ]));
    }

    /** @test */
    public function it_returns_an_address_when_created()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => $firstName = $this->faker->firstName,
            'last_name' => $lastName = $this->faker->lastName,
            'company_name' => $companyName = $this->faker->company,
            'address_line_1' => $addressLine1 = $this->faker->streetAddress,
            'postal_code' => $postalCode = $this->faker->postcode,
            'city' => $city = $this->faker->city,
            'country_id' => factory(Country::class)->create()->id
        ]);

        $response->assertJsonFragment([
            'id' => $response->getData()->data->id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'company_name' => $companyName,
            'address_line_1' => $addressLine1,
            'postal_code' => $postalCode,
            'city' => $city
        ]);
    }
}
