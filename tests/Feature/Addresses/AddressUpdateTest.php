<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Addresses\AddressResource;

class AddressUpdateTest extends TestCase
{
    use WithFaker;
    
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
        $response = $this->patchJson(route('addresses.update', $this->address));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_first_name()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_first_name_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'first_name' => 123
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_first_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'first_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_first_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'first_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['first_name']);
    }

    /** @test */
    public function it_requires_a_last_name()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'last_name' => 123
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'last_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_last_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'last_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['last_name']);
    }

    /** @test */
    public function it_requires_a_company_name_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'company_name' => 123
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_a_company_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'company_name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_a_company_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'company_name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['company_name']);
    }

    /** @test */
    public function it_requires_an_address_line_1()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_1' => 123
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_with_a_minimum_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_1' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_1_with_a_maximum_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_1' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['address_line_1']);
    }

    /** @test */
    public function it_requires_an_address_line_2_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_2' => 123
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_an_address_line_2_with_a_minimum_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_2' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_an_address_line_2_with_a_maximum_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'address_line_2' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['address_line_2']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'postal_code' => 123
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_with_a_minimum_of_4_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'postal_code' => str_repeat('1', 3)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_with_a_maximum_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'postal_code' => str_repeat('1', 256)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'city' => 123
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_with_a_minimum_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'city' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_with_a_maximum_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'city' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country_id()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_cannot_update_another_users_address()
    {
        $address = factory(Address::class)->create();

        $response = $this->patchJsonAs($this->user, route('addresses.update', $address), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->streetSuffix,
            'postal_code' => (string) $this->faker->numberBetween(1000, 4000),
            'city' => $this->faker->city,
            'country_id' => $this->address->country_id,
            'is_default' => false
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_update_the_users_address()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), $payload = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->streetSuffix,
            'postal_code' => (string) $this->faker->numberBetween(1000, 4000),
            'city' => $this->faker->city,
            'country_id' => $this->address->country_id,
            'is_default' => false
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $this->user->id
        ]));
    }

    /** @test */
    public function it_returns_an_address_resource()
    {
        $response = $this->patchJsonAs($this->user, route('addresses.update', $this->address), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->streetSuffix,
            'postal_code' => (string) $this->faker->numberBetween(1000, 4000),
            'city' => $this->faker->city,
            'country_id' => $this->address->country_id,
            'is_default' => false
        ]);

        $response->assertOk();

        $response->assertResource(new AddressResource($this->user->addresses()->first()));
    }
}
