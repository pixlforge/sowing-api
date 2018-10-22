<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->name,
        'slug' => str_slug($name),
        'description' => $faker->sentence,
        'price' => 1000
    ];
});
