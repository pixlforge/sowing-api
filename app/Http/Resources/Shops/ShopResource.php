<?php

namespace App\Http\Resources\Shops;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Countries\CountryResource;

class ShopResource extends JsonResource
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
            'name' => $this->name,
            'description_short' => [
                'en' => $this->getTranslation('description_short', 'en'),
                'fr' => $this->getTranslation('description_short', 'fr'),
                'de' => $this->getTranslation('description_short', 'de'),
                'it' => $this->getTranslation('description_short', 'it')
            ],
            'description_long' => [
                'en' => $this->getTranslation('description_long', 'en'),
                'fr' => $this->getTranslation('description_long', 'fr'),
                'de' => $this->getTranslation('description_long', 'de'),
                'it' => $this->getTranslation('description_long', 'it')
            ],
            'theme_color' => $this->theme_color,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => new CountryResource($this->country)
        ];
    }
}
