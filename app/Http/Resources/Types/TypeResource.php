<?php

namespace App\Http\Resources\Types;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
                'en' => $this->getTranslation('name', 'en'),
                'fr' => $this->getTranslation('name', 'fr'),
                'de' => $this->getTranslation('name', 'de'),
                'it' => $this->getTranslation('name', 'it'),
            ]
        ];
    }
}
