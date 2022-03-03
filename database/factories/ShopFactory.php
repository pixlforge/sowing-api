<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $name = $this->faker->sentence,
            'description_short' => [
                'en' => $descriptionShort = $this->faker->unique()->name,
                'fr' => $descriptionShort,
                'de' => $descriptionShort,
                'it' => $descriptionShort,
            ],
            'description_long' => [
                'en' => $descriptionLong = $this->faker->unique()->name,
                'fr' => $descriptionLong,
                'de' => $descriptionLong,
                'it' => $descriptionLong,
            ],
            'theme' => Arr::random([
                'green', 'pink', 'purple', 'indigo', 'blue', 'brown', 'gray', 'slate'
            ]),
            'postal_code' => Arr::random(range(1000, 4000)),
            'city' => $this->faker->city,
            'country_id' => Country::factory()
        ];
    }
}
