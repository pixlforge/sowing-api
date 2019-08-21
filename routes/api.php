<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Shops\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shops\UserShopController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Addresses\AddressController;
use App\Http\Controllers\Countries\CountryController;
use App\Http\Controllers\Shops\ShopCheckerController;
use App\Http\Controllers\Shops\ConnectShopController;
use App\Http\Controllers\Users\UserAccountController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Images\ShopImageStoreController;
use App\Http\Controllers\Newsletters\NewsletterController;
use App\Http\Controllers\Addresses\AddressShippingController;
use App\Http\Controllers\Categories\CategoryFeaturedController;
use App\Http\Controllers\PaymentMethods\PaymentMethodController;

/**
 * Auth
 */
Route::prefix('/auth')->name('auth.')->group(function () {

    // Register
    Route::post('/register', RegisterController::class)->name('register');

    // Login
    Route::post('/login', LoginController::class)->name('login');

    // Logout
    Route::post('/logout', LogoutController::class)->name('logout');

    // Me
    Route::get('/me', MeController::class)->name('me');

    // Verify
    Route::post('/verify', VerificationController::class)->name('verify');

    // Forgot password
    Route::post('/forgot', ForgotPasswordController::class)->name('forgot');

    // Reset password
    Route::post('/reset', ResetPasswordController::class)->name('reset');
});

/**
 * Cart
 */
Route::apiResource('/cart', CartController::class)
    ->parameters([
        'cart' => 'variation'
    ]);

/**
 * Addresses
 */
Route::apiResource('/addresses', AddressController::class);
Route::get('/addresses/{address}/shipping', AddressShippingController::class)->name('addresses.shipping');

/**
 * Categories
 */
Route::get('/categories/featured', CategoryFeaturedController::class)->name('categories.featured');
Route::apiResource('/categories', CategoryController::class);

/**
 * Countries
 */
Route::apiResource('/countries', CountryController::class);

/**
 * Images
 */
Route::post('/images/{shop}/upload', ShopImageStoreController::class)->name('shop.image.store');

/**
 * Newsletters
 */
Route::post('/newsletter/subscribe', NewsletterController::class)->name('newsletter.subscriber.store');

/**
 * Orders
 */
Route::apiResource('/orders', OrderController::class);

/**
 * Payment methods
 */
Route::apiResource('/payment-methods', PaymentMethodController::class);

/**
 * Products
 */
Route::apiResource('/products', ProductController::class);

/**
 * Shops
 */
Route::apiResource('/shops', ShopController::class);
Route::get('/user/shop', UserShopController::class)->name('user.shop');
Route::post('/shops/checker', ShopCheckerController::class)->name('shop.checker');
Route::post('/shops/connect', ConnectShopController::class)->name('shops.connect');

/**
 * User
 */
Route::apiResource('/user/account', UserAccountController::class)
    ->names('user.account')
    ->parameters([
        'account' => 'user'
    ]);
