<?php

/**
 * Auth
 */
Route::prefix('/auth')->namespace('Auth')->name('auth.')->group(function () {

    // Register
    Route::post('/register', 'RegisterController')->name('register');

    // Login
    Route::post('/login', 'LoginController')->name('login');

    // Logout
    Route::post('/logout', 'LogoutController')->name('logout');

    // Me
    Route::get('/me', 'MeController')->name('me');
});

/**
 * Cart
 */
Route::namespace('Cart')->group(function () {
    Route::resource('/cart', 'CartController', [
        'parameters' => [
            'cart' => 'variation'
        ]
    ]);
});

/**
 * Addresses
 */
Route::namespace('Addresses')->group(function () {
    Route::resource('/addresses', 'AddressController');
    Route::get('/addresses/{address}/shipping', 'AddressShippingController')->name('addresses.shipping');
});

/**
 * Categories
 */
Route::namespace('Categories')->group(function () {
    Route::resource('/categories', 'CategoryController');
});

/**
 * Countries
 */
Route::namespace('Countries')->group(function () {
    Route::resource('/countries', 'CountryController');
});

/**
 * Products
 */
Route::namespace('Products')->group(function () {
    Route::resource('/products', 'ProductController');
});
