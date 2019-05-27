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

    // Verify
    Route::post('/verify', 'VerificationController')->name('verify');

    // Forgot password
    Route::post('/forgot', 'ForgotPasswordController')->name('forgot');

    // Reset password
    Route::post('/reset', 'ResetPasswordController')->name('reset');
});

/**
 * Cart
 */
Route::namespace('Cart')->group(function () {
    Route::apiResource('/cart', 'CartController', [
        'parameters' => [
            'cart' => 'variation'
        ]
    ]);
});

/**
 * Addresses
 */
Route::namespace('Addresses')->group(function () {
    Route::apiResource('/addresses', 'AddressController');
    Route::get('/addresses/{address}/shipping', 'AddressShippingController')->name('addresses.shipping');
});

/**
 * Categories
 */
Route::namespace('Categories')->group(function () {
    Route::apiResource('/categories', 'CategoryController');
});

/**
 * Countries
 */
Route::namespace('Countries')->group(function () {
    Route::apiResource('/countries', 'CountryController');
});

/**
 * Images
 */
Route::namespace('Images')->group(function () {
    
    /**
     * Shops
     */
    Route::post('/images/{shop}/upload', 'ShopImageController@store')->name('shop.image.store');
});

/**
 * Newsletters
 */
Route::namespace('Newsletters')->group(function () {
    Route::post('/newsletter/subscribe', 'NewsletterController@store')->name('newsletter.subscriber.store');
});

/**
 * Orders
 */
Route::namespace('Orders')->group(function () {
    Route::apiResource('/orders', 'OrderController');
});

/**
 * Payment methods
 */
Route::namespace('PaymentMethods')->group(function () {
    Route::apiResource('/payment-methods', 'PaymentMethodController');
});

/**
 * Products
 */
Route::namespace('Products')->group(function () {
    Route::apiResource('/products', 'ProductController');
});

/**
 * Shops
 */
Route::namespace('Shops')->group(function () {
    Route::apiResource('/shops', 'ShopController');
    Route::get('/user/shop', 'UserShopController')->name('user.shop');
    Route::post('/shops/checker', 'ShopCheckerController')->name('shop.checker');

    /**
     * Connect
     */
    Route::post('/shops/connect', 'ConnectShopController')->name('shops.connect');
});
