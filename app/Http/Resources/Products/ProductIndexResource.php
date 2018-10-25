<?php

namespace App\Http\Resources\Products;

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
            ]
        ];
    }
}
