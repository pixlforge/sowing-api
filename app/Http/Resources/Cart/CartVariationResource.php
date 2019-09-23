<?php

namespace App\Http\Resources\Cart;

use App\Money\Money;
use App\Http\Resources\Variations\VariationResource;
use App\Http\Resources\Products\ProductIndexResource;

class CartVariationResource extends VariationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'product' => new ProductIndexResource($this->product),
            'quantity' => (int) $this->pivot->quantity,
            'total' => [
                'detailed' => $this->getTotal()->detailed(),
                'formatted' => $this->getTotal()->formatted()
            ]
        ]);
    }

    /**
     * Get the variation total.
     *
     * @return App\Money\Money
     */
    protected function getTotal()
    {
        return new Money($this->pivot->quantity * $this->price->getAmount());
    }
}
