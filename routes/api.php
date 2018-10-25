<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Categories')->group(function () {
    Route::resource('/categories', 'CategoryController')->names([
        'index' => 'categories.index',
        'show' => 'categories.show',
    ]);
});

Route::namespace('Products')->group(function () {
    Route::resource('/products', 'ProductController')->names([
        'index' => 'products.index',
        'show' => 'products.show',
    ]);
});
