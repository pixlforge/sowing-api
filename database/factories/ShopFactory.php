<?php

use Faker\Factory;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Shop::class, function (Faker $faker) use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'user_id' => factory(User::class),
        'name' => $name = $faker->sentence,
        'description_short' => [
            'en' => $descriptionShort = $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ],
        'description_long' => [
            'en' => $descriptionLong = $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ],
        'theme' => Arr::random([
            'green', 'pink', 'purple', 'indigo', 'blue', 'brown', 'grey', 'slate'
        ]),
        'postal_code' => Arr::random(range(1000, 4000)),
        'city' => $faker->city,
        'country_id' => factory(Country::class)
    ];
});
