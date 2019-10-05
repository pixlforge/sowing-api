<?php

namespace App\Http\Resources\PaymentMethods;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'card_type' => $this->card_type,
            'card_type_slug' => $this->card_type_slug,
            'last_four' => $this->last_four,
            'is_default' => $this->isDefault(),
            'created_at' => [
                'en' => $this->created_at->locale('en')->longAbsoluteDiffForHumans(),
                'fr' => $this->created_at->locale('fr')->longAbsoluteDiffForHumans(),
                'de' => $this->created_at->locale('de')->longAbsoluteDiffForHumans(),
                'it' => $this->created_at->locale('it')->longAbsoluteDiffForHumans(),
            ]
        ];
    }
}
