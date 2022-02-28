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
        'shop_id' => Shop::factory(),
        'name' => [
            'en' => $name = $fakerEN->unique()->name,
            'fr' => $fakerFR->unique()->name,
            'de' => $fakerDE->unique()->name,
            'it' => $fakerIT->unique()->name,
        ],
        'description' => [
            'en' => $fakerEN->paragraphs(rand(2, 6), true),
            'fr' => $fakerFR->paragraphs(rand(2, 6), true),
            'de' => $fakerDE->paragraphs(rand(2, 6), true),
            'it' => $fakerIT->paragraphs(rand(2, 6), true),
        ],
        'price' => 1000
    ];
});
