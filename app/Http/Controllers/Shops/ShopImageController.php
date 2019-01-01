<?php

namespace App\Http\Controllers\Shops;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopImageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:api']);
    // }

    public function store(Shop $shop, Request $request)
    {
        dump($shop);
    }
}
