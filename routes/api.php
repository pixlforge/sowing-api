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
 * Categories
 */
Route::namespace('Categories')->group(function () {
    Route::resource('/categories', 'CategoryController');
});

/**
 * Products
 */
Route::namespace('Products')->group(function () {
    Route::resource('/products', 'ProductController');
});
