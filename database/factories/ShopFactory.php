<?php

use Faker\Factory;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use Faker\Generator as Faker;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Shop::class, function (Faker $faker) use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'name' => $name = $faker->sentence,
        'slug' => str_slug($name),
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
        'theme_color' => array_random([
            Shop::THEME_GREEN,
            Shop::THEME_PINK,
            Shop::THEME_PURPLE,
            Shop::THEME_INDIGO,
            Shop::THEME_BLUE,
            Shop::THEME_BROWN,
            Shop::THEME_GREY,
            Shop::THEME_SLATE,
        ]),
        'postal_code' => array_random(range(1000, 4000)),
        'city' => $faker->city,
        'country_id' => function () {
            return factory(Country::class)->create()->id;
        }
    ];
});
