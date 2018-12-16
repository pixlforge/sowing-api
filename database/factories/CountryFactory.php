<?php

use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'code' => $faker->countryCode,
        'name' => [
            'en' => $country = $faker->country,
            'fr' => $country,
            'de' => $country,
            'it' => $country,
        ]
    ];
});
