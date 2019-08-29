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
    public function it_cannot_update_another_users_address()
    {
        $address = factory(Address::class)->create();

        $response = $this->patchJsonAs($this->user, route('addresses.update', $address), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->streetSuffix,
            'postal_code' => $this->faker->numberBetween(1000, 4000),
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
            'postal_code' => $this->faker->numberBetween(1000, 4000),
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
            'postal_code' => $this->faker->numberBetween(1000, 4000),
            'city' => $this->faker->city,
            'country_id' => $this->address->country_id,
            'is_default' => false
        ]);

        $response->assertOk();

        $response->assertResource(new AddressResource($this->user->addresses()->first()));
    }
}
