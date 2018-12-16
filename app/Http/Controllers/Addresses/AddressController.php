<?php

namespace App\Http\Controllers\Addresses;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Addresses\AddressResource;
use App\Http\Requests\Addresses\AddressStoreRequest;

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
     * @return \App\Http\Resources\Addresses\AddressResource
     */
    public function index(Request $request)
    {
        return AddressResource::collection($request->user()->addresses);
    }

    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only([
            'first_name', 'last_name', 'company_name', 'address_line_1', 'address_line_2', 'postal_code', 'city', 'country_id',
        ]));

        $request->user()->addresses()->save($address);

        return new AddressResource($address);
    }
}
