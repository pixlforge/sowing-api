<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\Address;
use App\Models\Product;
use App\Policies\ShopPolicy;
use App\Models\PaymentMethod;
use App\Policies\AddressPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PaymentMethodPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Address::class => AddressPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
        Product::class => ProductPolicy::class,
        Shop::class => ShopPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
