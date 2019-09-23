<?php

namespace App\Models\Traits;

use App\Money\Money;

trait HasPrice
{
    /**
     * Get the model's Money instance price attribute.
     *
     * @param $value
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }

    /**
     * Get the model's formatted Money instance price attribute.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price->formatted();
    }

    /**
     * Returns an object which contains the amount and currency.
     *
     * @return array
     */
    public function getDetailedPriceAttribute()
    {
        return $this->price->detailed();
    }
}
