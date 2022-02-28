<?php

use App\Models\Stock;
use App\Models\ProductVariation;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'product_variation_id' => ProductVariation::factory(),
        'quantity' => 1
    ];
});
