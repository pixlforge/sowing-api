<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use App\Models\Address;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address_line_1' => $this->faker->address,
            'address_line_2' => (string) Arr::random(range(1, 100)),
            'postal_code' => (string) Arr::random(range(1000, 4000)),
            'city' => $this->faker->city,
            'country_id' => Country::factory(),
            'is_default' => false
        ];
    }

    /**
     * Indicate that the address is the default one.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function default()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_default' => true
            ];
        });
    }
}
