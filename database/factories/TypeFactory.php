<?php

use Faker\Factory;
use App\Models\Type;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Type::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'name_en' => $name_en = $fakerEN->unique()->name,
        'name_fr' => $name_fr = $fakerFR->unique()->name,
        'name_de' => $name_de = $fakerDE->unique()->name,
        'name_it' => $name_it = $fakerIT->unique()->name,
    ];
});
