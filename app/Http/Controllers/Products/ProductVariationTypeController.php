<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\ProductVariationTypes\ProductVariationTypeResource;
use App\Models\ProductVariationType;

class ProductVariationTypeController extends Controller
{
    /**
     * ProductVariationTypeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    
    /**
     * Store a new empty product variation type.
     *
     * @param Product $product
     * @return void
     */
    public function store(Product $product)
    {
        $this->authorize('update', $product);
        
        $product->types()->create();

        $product->load('types');

        return ProductResource::make($product);
    }
}
