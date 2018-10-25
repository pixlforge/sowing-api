<?php

use Faker\Factory;
use App\Models\Category;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Category::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'name_en' => $name_en = $fakerEN->unique()->name,
        'name_fr' => $name_fr = $fakerFR->unique()->name,
        'name_de' => $name_de = $fakerDE->unique()->name,
        'name_it' => $name_it = $fakerIT->unique()->name,
        'description_en' => $fakerEN->sentence,
        'description_fr' => $fakerFR->sentence,
        'description_de' => $fakerDE->sentence,
        'description_it' => $fakerIT->sentence,
        'slug' => str_slug($name_en),
    ];
});
