<?php

namespace App\Http\Controllers\Countries;

use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Countries\CountryResource;

class CountryController extends Controller
{
    /**
     * CountryController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Returns a collection of all countries.
     *
     * @return CountryResource
     */
    public function index()
    {
        return CountryResource::collection(Country::get());
    }
}
