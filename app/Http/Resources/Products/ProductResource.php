<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\ProductVariations\ProductVariationResource;

class ProductResource extends ProductIndexResource
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
            'category' => $this->categories->first(),
            'variations' => ProductVariationResource::collection(
                $this->variations
            )->groupBy('type.id')
        ]);
    }
}
