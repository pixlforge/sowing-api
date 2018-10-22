<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => [
                'en' => $this->name_en,
                'fr' => $this->name_fr,
                'de' => $this->name_de,
                'it' => $this->name_it
            ],
            'slug' => $this->slug,
            'children' => CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
