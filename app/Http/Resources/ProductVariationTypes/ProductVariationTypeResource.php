<?php

namespace App\Http\Resources\ProductVariationTypes;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationTypeResource extends JsonResource
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
            'name' => [
                'en' => $this->getTranslation('name', 'en'),
                'fr' => $this->getTranslation('name', 'fr'),
                'de' => $this->getTranslation('name', 'de'),
                'it' => $this->getTranslation('name', 'it'),
            ]
        ];
    }
}
