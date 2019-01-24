<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_name' => $faker->company,
        'address_line_1' => $faker->address,
        'address_line_2' => array_random(range(1, 100)),
        'postal_code' => array_random(range(1000, 4000)),
        'city' => $faker->city,
        'country_id' => factory(Country::class),
        'is_default' => false
    ];
});

$factory->state(Address::class, 'default', function () {
    return [
        'is_default' => true
    ];
});
