<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Variations\VariationResource;
use App\Http\Resources\Addresses\AddressResource;
use App\Http\Resources\ShippingMethods\ShippingMethodResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'subtotal' => [
                'detailed' => $this->subtotal->detailed(),
                'formatted' => $this->subtotal->formatted()
            ],
            'total' => [
                'detailed' => $this->total()->detailed(),
                'formatted' => $this->total()->formatted()
            ],
            'variations' => VariationResource::collection($this->whenLoaded('variations')),
            'address' => new AddressResource($this->whenLoaded('address')),
            'shippingMethod' => new ShippingMethodResource($this->whenLoaded('shippingMethod')),
        ];
    }
}
