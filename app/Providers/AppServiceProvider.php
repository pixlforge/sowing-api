<?php

namespace App\Providers;

use App\Cart\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Category;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\AddressObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Models\Shop;
use App\Observers\ShopObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Address::observe(AddressObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
        Shop::observe(ShopObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {
            if ($app->auth->user()) {
                $app->auth->user()->load(['cart.stock']);
            }
            
            return new Cart($app->auth->user());
        });
    }
}
