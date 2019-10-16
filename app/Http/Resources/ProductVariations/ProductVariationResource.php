<?php

namespace App\Http\Resources\ProductVariations;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Resources\ProductVariationTypes\ProductVariationTypeResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return ProductVariationResource::collection($this->resource);
        }

        return [
            'id' => $this->id,
            'name' => [
                'en' => $this->getTranslation('name', 'en'),
                'fr' => $this->getTranslation('name', 'fr'),
                'de' => $this->getTranslation('name', 'de'),
                'it' => $this->getTranslation('name', 'it')
            ],
            'description' => [
                'en' => $this->getTranslation('description', 'en'),
                'fr' => $this->getTranslation('description', 'fr'),
                'de' => $this->getTranslation('description', 'de'),
                'it' => $this->getTranslation('description', 'it')
            ],
            'product' => new ProductIndexResource($this->whenLoaded('product')),
            'price' => $this->price,
            'order' => $this->order,
            'price' => [
                'detailed' => $this->detailedPrice,
                'formatted' => $this->formattedPrice
            ],
            'price_varies' => $this->priceVaries(),
            'type' => new ProductVariationTypeResource($this->type),
            'stock_count' => (int) $this->stockCount(),
            'in_stock' => $this->inStock(),
        ];
    }
}
