<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Variations\VariationResource;

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
            'variations' => VariationResource::collection(
                $this->variations
            )->groupBy('type.id')
        ]);
    }
}
