<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\ProductVariationType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariationTypes\ProductVariationTypeResource;
use App\Http\Requests\ProductVariationTypes\ProductVariationTypeUpdateRequest;

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

    /**
     * Update an existing product variation type.
     *
     * @param Product $product
     * @param ProductVariationType $productVariationType
     * @param ProductVariationTypeUpdateRequest $request
     * @return void
     */
    public function update(Product $product, ProductVariationType $productVariationType, ProductVariationTypeUpdateRequest $request)
    {
        $this->authorize('update', $product);

        $productVariationType->update($request->only('name'));
    }
}
