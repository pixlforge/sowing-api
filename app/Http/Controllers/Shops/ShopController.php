<?php

namespace App\Http\Controllers\Shops;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Shops\ShopResource;
use App\Http\Requests\Shops\ShopStoreRequest;
use App\Http\Requests\Shops\ShopUpdateRequest;

class ShopController extends Controller
{
    /**
     * ShopController constructor.
     */
    public function __construct()
    {
        return $this->middleware(['auth:api'])->except(['show']);
    }

    /**
     * Get a single shop.
     *
     * @param Shop $shop
     * @return ShopResource
     */
    public function show(Shop $shop)
    {
        $shop->load(['country']);
        
        return new ShopResource($shop);
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
            'name', 'description_short', 'description_long', 'theme', 'postal_code', 'city', 'country_id'
        ]));

        $request->user()->shop()->save($shop);

        return new ShopResource($shop);
    }

    /**
     * Update an existing shop.
     *
     * @param ShopUpdateRequest $request
     * @param Shop $shop
     * @return ShopResource
     */
    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);
        
        $shop->update($request->only([
            'description_short', 'description_long', 'theme', 'postal_code', 'city', 'country_id'
        ]));

        return new ShopResource($shop);
    }
}
