<?php

namespace App\Providers;

use App\Cart\Cart;
use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Observers\UserObserver;
use App\Observers\AddressObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Address::observe(AddressObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {
            $app->auth->user()->load(['cart.stock']);
            
            return new Cart($app->auth->user());
        });
    }
}
