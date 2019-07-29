<?php

use Faker\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Category::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'name' => [
            'en' => $name = $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ],
        'description' => [
            'en' => null,
            'fr' => null,
            'de' => null,
            'it' => null,
        ],
        'slug' => Str::slug($name),
    ];
});

$factory->state(Category::class, 'hasParent', function () {
    return [
        'parent_id' => factory(Category::class)
    ];
});
