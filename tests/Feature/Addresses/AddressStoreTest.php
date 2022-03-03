<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Country;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Addresses\AddressResource;

class AddressStoreTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
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
    public function it_requires_a_first_name_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => 123
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_first_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_first_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_last_name()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'last_name' => 123
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'last_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'last_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_company_name_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'company_name' => 123
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_a_company_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'company_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_a_company_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'company_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_an_address_line_1()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_1' => 123
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_with_a_minimum_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_1' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_with_a_maximum_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_1' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_2_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_2' => 123
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_an_address_line_2_with_a_minimum_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_2' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_an_address_line_2_with_a_maximum_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'address_line_2' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'postal_code' => 123
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_with_a_minimum_of_4_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'postal_code' => str_repeat('1', 3)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_with_a_maximum_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'postal_code' => str_repeat('1', 256)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'city' => 123
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_with_a_minimum_of_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'city' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_with_a_maximum_of_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'city' => str_repeat('a', 256)
        ]);

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
            'country_id' => Country::factory()->create()->id
        ]);

        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $this->user->id,
        ]));
    }

    /** @test */
    public function it_returns_an_address_resource_when_created()
    {
        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => Country::factory()->create()->id
        ]);

        $response->assertResource(AddressResource::make($this->user->addresses->first()));
    }

    /** @test */
    public function it_unsets_old_addresses_as_default_when_creating()
    {
        $this->user->addresses()->save(
            Address::factory()->default()->make()
        );

        $this->assertTrue($this->user->addresses->first()->isDefault());

        $response = $this->postJsonAs($this->user, route('addresses.store'), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => $this->user->addresses->first()->country->id,
            'is_default' => true
        ]);

        $response->assertSuccessful();

        $this->assertFalse($this->user->addresses->first()->fresh()->isDefault());

        $this->assertTrue($this->user->addresses->last()->isDefault());
    }
}
