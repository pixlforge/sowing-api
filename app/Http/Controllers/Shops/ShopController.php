<?php

namespace App\Http\Controllers\Shops;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shops\ShopStoreRequest;
use App\Http\Resources\Shops\ShopResource;

class ShopController extends Controller
{
    /**
     * ShopController constructor.
     */
    public function __construct()
    {
        return $this->middleware(['auth:api']);
    }

    /**
     * Store a new shop.
     *
     * @param ShopStoreRequest $request
     * @return ShopResource
     */
    public function store(ShopStoreRequest $request)
    {
        $shop = Shop::make($request->only([
            'name', 'description_short', 'description_long', 'theme_color', 'postal_code', 'city', 'country_id'
        ]));

        $request->user()->shop()->save($shop);

        return new ShopResource($shop);
    }
}
