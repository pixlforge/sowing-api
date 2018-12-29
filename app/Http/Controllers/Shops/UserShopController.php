<?php

namespace App\Http\Controllers\Shops;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Shops\ShopResource;

class UserShopController extends Controller
{
    /**
     * UserShopController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Get the authenticated user's shop details.
     *
     * @param Request $request
     * @return ShopResource
     */
    public function __invoke(Request $request)
    {
        $shop = $request->user()->shop;
        
        return new ShopResource($shop);
    }
}
