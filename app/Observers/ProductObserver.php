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
            $product->slug = Str::uuid() . '-' . Str::slug($this->getAvailableTranslation($product));
        }
    }

    /**
     * Get one of the available translations.
     *
     * @param Product $product
     * @return string
     */
    protected function getAvailableTranslation(Product $product)
    {
        $locale = '';

        if ($product->hasTranslation('name', 'en')) {
            $locale = 'en';
        } elseif ($product->hasTranslation('name', 'fr')) {
            $locale = 'fr';
        } elseif ($product->hasTranslation('name', 'de')) {
            $locale = 'de';
        } elseif ($product->hasTranslation('name', 'it')) {
            $locale = 'it';
        }

        return $product->getTranslation('name', $locale);
    }
}
