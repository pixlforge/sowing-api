<?php

use Faker\Factory;
use App\Models\Shop;
use App\Models\Product;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(Product::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
        'shop_id' => factory(Shop::class),
        'name' => [
            'en' => $name = $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ],
        'description' => [
            'en' => $fakerEN->sentence,
            'fr' => $fakerFR->sentence,
            'de' => $fakerDE->sentence,
            'it' => $fakerIT->sentence,
        ],
        'slug' => str_slug($name),
        'price' => 1000
    ];
});
