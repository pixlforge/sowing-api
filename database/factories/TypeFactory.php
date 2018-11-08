<?php

use Faker\Factory;
use App\Models\Type;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Type::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'name' => [
            'en' => $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ]
    ];
});
