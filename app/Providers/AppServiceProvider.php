<?php

namespace App\Providers;

use App\Cart\Cart;
use App\Models\User;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Observers\UserObserver;
use App\Observers\ShopObserver;
use App\Observers\OrderObserver;
use App\Observers\AddressObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Observers\PaymentMethodObserver;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModelObservers();

        $this->disableSearchSyncingInDev();
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

    /**
     * Register the various model observers.
     *
     * @return void
     */
    protected function registerModelObservers()
    {
        Address::observe(AddressObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);
        PaymentMethod::observe(PaymentMethodObserver::class);
        Product::observe(ProductObserver::class);
        User::observe(UserObserver::class);
        Shop::observe(ShopObserver::class);
    }

    /**
     * Disable Algolia search syncing while not in production.
     *
     * @return void
     */
    protected function disableSearchSyncingInDev()
    {
        if (config('app.env') !== 'production') {
            Shop::disableSearchSyncing();
            Product::disableSearchSyncing();
        }
    }
}
