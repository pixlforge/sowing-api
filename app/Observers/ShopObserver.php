<?php

namespace App\Observers;

use App\Models\Shop;

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
        $shop->slug = str_slug($shop->name);
    }
}
