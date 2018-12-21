<?php

namespace App\Models\Collections;

use Illuminate\Database\Eloquent\Collection;

class VariationCollection extends Collection
{
    /**
     * Returns the product variations keyed by id along with their respective quantity.
     *
     * @return array
     */
    public function forSyncing()
    {
        return $this->keyBy('id')
            ->map(function ($variation) {
                return [
                    'quantity' => $variation->pivot->quantity
                ];
            })
            ->toArray();
    }
}
