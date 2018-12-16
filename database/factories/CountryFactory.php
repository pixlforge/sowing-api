<?php

use App\Models\Country;

$factory->define(Country::class, function () {
    return [
        'code' => 'XX',
        'name' => [
            'en' => '',
            'fr' => '',
            'de' => '',
            'it' => '',
        ]
    ];
});
