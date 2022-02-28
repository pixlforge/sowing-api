<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => User::factory(),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_name' => $faker->company,
        'address_line_1' => $faker->address,
        'address_line_2' => (string) Arr::random(range(1, 100)),
        'postal_code' => (string) Arr::random(range(1000, 4000)),
        'city' => $faker->city,
        'country_id' => Country::factory(),
        'is_default' => false
    ];
});

$factory->state(Address::class, 'default', function () {
    return [
        'is_default' => true
    ];
});
