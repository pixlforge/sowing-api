<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\ShippingMethod;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'address_id' => function () {
            return factory(Address::class)->create()->id;
        },
        'shipping_method_id' => function () {
            return factory(ShippingMethod::class)->create()->id;
        },
        'subtotal' => 1000
    ];
});
