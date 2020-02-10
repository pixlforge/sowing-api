<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductVariationTypeController extends Controller
{
    /**
     * Store a new product variation type.
     *
     * @param Product $product
     * @return void
     */
    public function store(Request $request, Product $product)
    {
        dd($product);
    }
}
