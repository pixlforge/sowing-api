<?php

namespace App\Http\Controllers\Shops;

use App\Models\Shop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCheckerController extends Controller
{
    /**
     * ShopCheckerController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Check if the name is available.
     *
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $originalName = $request->name;
        $slugifiedName = Str::slug($request->name);

        $result = Shop::where('name', $originalName)->orWhere('slug', $slugifiedName)->first();

        if ($result) {
            return response(['status' => 409], 409);
        }

        return response(['status' => 202], 202);
    }
}
