<?php

namespace App\Observers;

use App\Models\Shop;
use Illuminate\Support\Str;

class ShopObserver
{
    /**
     * Handle the shop "created" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function creating(Shop $shop)
    {
        $shop->slug = Str::slug($shop->name);
    }
}
