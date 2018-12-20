<?php

namespace App\Http\Controllers\Addresses;

use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingMethods\ShippingMethodResource;

class AddressShippingController extends Controller
{
    /**
     * AddressShippingController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    
    /**
     * Request the associated shipping methods for a given address.
     *
     * @param Address $address
     * @return App\Http\Resources\ShippingMethods\ShippingMethodResource
     */
    public function __invoke(Address $address)
    {
        $this->authorize('show', $address);

        return ShippingMethodResource::collection(
            $address->country->shippingMethods
        );
    }
}
