<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Faker\Generator as Faker;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'address_id' => factory(Address::class),
        'shipping_method_id' => factory(ShippingMethod::class),
        'payment_method_id' => factory(PaymentMethod::class),
        'subtotal' => 1000
    ];
});
