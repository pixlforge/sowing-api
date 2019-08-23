<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
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
            'email' => $this->email,
            'is_verified' => $this->isVerified(),
            'has_shop' => $this->hasShop(),
            'member_for' => [
                'en' => $this->created_at->locale('en')->longAbsoluteDiffForHumans(),
                'fr' => $this->created_at->locale('fr')->longAbsoluteDiffForHumans(),
                'de' => $this->created_at->locale('de')->longAbsoluteDiffForHumans(),
                'it' => $this->created_at->locale('it')->longAbsoluteDiffForHumans(),
            ]
        ];
    }
}
