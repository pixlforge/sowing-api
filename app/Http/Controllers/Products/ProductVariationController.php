<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariations\ProductVariationResource;
use App\Models\ProductVariationType;

class ProductVariationController extends Controller
{
    /**
     * ProductVariationController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    
    /**
     * Store a new product variation.
     *
     * @param Product $product
     * @param ProductVariationType $productVariationType
     * @return ProductVariationResource
     */
    public function store(Product $product, ProductVariationType $productVariationType)
    {
        $this->authorize('update', $product);
        
        $productVariation = $product->variations()->create([
            'product_variation_type_id' => $productVariationType->id()
        ]);

        return ProductVariationResource::make($productVariation);
    }
}
