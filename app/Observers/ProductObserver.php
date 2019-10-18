<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        if (is_null($product->slug)) {
            $product->slug = $product->shop_id . now()->unix() . '-' . Str::slug($product->getTranslation('name', 'en'));
        }
    }
}
