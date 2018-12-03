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
    Route::resource('/cart', 'CartController')->names([
        'store' => 'cart.store',
    ]);
});

/**
 * Categories
 */
Route::namespace('Categories')->group(function () {
    Route::resource('/categories', 'CategoryController')->names([
        'index' => 'categories.index',
        'show' => 'categories.show',
    ]);
});

/**
 * Products
 */
Route::namespace('Products')->group(function () {
    Route::resource('/products', 'ProductController')->names([
        'index' => 'products.index',
        'show' => 'products.show',
    ]);
});
