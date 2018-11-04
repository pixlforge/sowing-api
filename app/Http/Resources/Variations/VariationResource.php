<?php

namespace App\Http\Resources\Variations;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
                'en' => $this->name_en,
                'fr' => $this->name_fr,
                'de' => $this->name_de,
                'it' => $this->name_it,
            ],
            'description' => [
                'en' => $this->description_en,
                'fr' => $this->description_fr,
                'de' => $this->description_de,
                'it' => $this->description_it,
            ],
            'price' => $this->price,
            'order' => $this->order,
        ];
    }
}
