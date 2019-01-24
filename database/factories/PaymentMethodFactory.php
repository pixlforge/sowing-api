<?php

use App\Models\User;
use Faker\Generator as Faker;
use App\Models\PaymentMethod;

$factory->define(PaymentMethod::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'card_type' => 'Mastercard',
        'last_four' => '4242',
        'provider_id' => str_random(10)
    ];
});

$factory->state(PaymentMethod::class, 'default', function () {
    return [
        'is_default' => true,
    ];
});
