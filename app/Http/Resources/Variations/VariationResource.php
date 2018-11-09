<?php

namespace App\Http\Resources\Variations;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use App\Http\Resources\TypeResource;

class VariationResource extends JsonResource
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
            return VariationResource::collection($this->resource);
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
            'price' => $this->price,
            'order' => $this->order,
            'price' => $this->rawPrice,
            'price_varies' => $this->priceVaries(),
            'type' => new TypeResource($this->type)
        ];
    }
}
