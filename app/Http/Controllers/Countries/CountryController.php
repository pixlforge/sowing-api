<?php

namespace App\Http\Controllers\Countries;

use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Countries\CountryResource;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection(Country::get());
    }
}
