<?php

use App\Models\Stock;
use App\Models\Variation;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'variation_id' => factory(Variation::class),
        'quantity' => 1
    ];
});
