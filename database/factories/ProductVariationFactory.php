<?php

use Faker\Factory;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;

$fakerEN = Factory::create('en_US');
$fakerFR = Factory::create('fr_CH');
$fakerDE = Factory::create('de_CH');
$fakerIT = Factory::create('it_IT');

$factory->define(ProductVariation::class, function () use ($fakerEN, $fakerFR, $fakerDE, $fakerIT) {
    return [
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
        'price' => null,
        'order' => null,
        'product_variation_type_id' => factory(ProductVariationType::class),
        'product_id' => factory(Product::class),
    ];
});
