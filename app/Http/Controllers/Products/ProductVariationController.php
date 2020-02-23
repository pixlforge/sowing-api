<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariationType;

class ProductVariationController extends Controller
{
    public function store(Request $request, Product $product, ProductVariationType $productVariationType)
    {
        //  dump($product);
        // dd($productVariationType);
    }
}
