<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Shops\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
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
            'price' => $this->rawPrice,
            'stock_count' => $this->stockCount(),
            'in_stock' => $this->inStock(),
            'shop' => new ShopResource($this->shop)
        ];
    }
}
