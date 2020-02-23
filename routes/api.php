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
use App\Http\Controllers\Products\ProductVariationTypeController;

/**
 * Auth
 */
Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::get('/me', MeController::class)->name('me');
    Route::post('/verify', VerificationController::class)->name('verify');
    Route::post('/forgot', ForgotPasswordController::class)->name('forgot');
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
Route::get('/newsletter/subscribers', [NewsletterController::class, 'index'])->name('newsletter.subscribers.index');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscriber.store'); // TODO: Refactor the url

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
Route::apiResource('/products/{product}/product-variation-types', ProductVariationTypeController::class);

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
Route::get('/user/account', [UserAccountController::class, 'index'])->name('user.account.index');
Route::patch('/user/account', [UserAccountController::class, 'update'])->name('user.account.update');