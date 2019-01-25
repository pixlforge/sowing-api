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
            'slug' => $this->slug,
            'description_short' => [
                'en' => $this->getTranslation('description_short', 'en'),
                'fr' => $this->getTranslation('description_short', 'fr'),
                'de' => $this->getTranslation('description_short', 'de'),
                'it' => $this->getTranslation('description_short', 'it')
            ],
            'description_long' => [
                'en' => nl2br(e($this->getTranslation('description_long', 'en'))),
                'fr' => nl2br(e($this->getTranslation('description_long', 'fr'))),
                'de' => nl2br(e($this->getTranslation('description_long', 'de'))),
                'it' => nl2br(e($this->getTranslation('description_long', 'it')))
            ],
            'theme' => $this->theme,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => new CountryResource($this->whenLoaded('country')),
            'country_id' => $this->country->id,
            'stripe_user_id' => $this->stripe_user_id,
            'stripe_publishable_key' => $this->stripe_publishable_key,
            'media' => [
                'avatar' => optional($this->getFirstMedia('avatar'))->getFullUrl(),
                'cover' => optional($this->getFirstMedia('cover'))->getFullUrl()
            ]
        ];
    }
}
