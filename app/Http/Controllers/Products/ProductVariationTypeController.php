<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariationTypes\ProductVariationTypeResource;

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
        
        $type = $product->types()->create();

        return ProductVariationTypeResource::make($type);
    }
}
