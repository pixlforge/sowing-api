<?php

namespace App\Http\Controllers\Addresses;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Addresses\AddressResource;
use App\Http\Requests\Addresses\AddressStoreRequest;
use App\Http\Requests\Addresses\AddressUpdateRequest;

class AddressController extends Controller
{
    /**
     * AddressController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    
    /**
     * Returns a collection of a all the addresses a user owns.
     *
     * @param Request $request
     * @return AddressResource
     */
    public function index(Request $request)
    {
        return AddressResource::collection($request->user()->addresses);
    }

    /**
     * Store a new address and respond with an address resource.
     *
     * @param AddressStoreRequest $request
     * @return AddressResource
     */
    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only([
            'first_name', 'last_name', 'company_name', 'address_line_1', 'address_line_2', 'postal_code', 'city', 'country_id', 'is_default'
        ]));

        $request->user()->addresses()->save($address);

        return AddressResource::make($address);
    }

    /**
     * Show an address that belongs to the user.
     *
     * @param Address $address
     * @return AddressResource
     */
    public function show(Address $address)
    {
        $this->authorize('show', $address);

        return AddressResource::make($address);
    }

    /**
     * Update an address that belongs to the user.
     *
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return AddressResource
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $this->authorize('update', $address);
        
        $address->update($request->only([
            'first_name', 'last_name', 'company_name', 'address_line_1', 'address_line_2', 'postal_code', 'city', 'country_id', 'is_default'
        ]));

        return AddressResource::make($address);
    }

    /**
     * Delete an address that belongs to the user.
     *
     * @param Address $address
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(Address $address)
    {
        $this->authorize('destroy', $address);

        $address->delete();

        return response(null, 204);
    }
}
