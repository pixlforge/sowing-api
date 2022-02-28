<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Faker\Generator as Faker;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => User::factory(),
        'address_id' => Address::factory(),
        'shipping_method_id' => ShippingMethod::factory(),
        'payment_method_id' => PaymentMethod::factory(),
        'subtotal' => 1000
    ];
});
