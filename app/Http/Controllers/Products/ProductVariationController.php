<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariations\ProductVariationResource;
use Illuminate\Http\Request;

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
     * Get a specific product variation.
     *
     * @param Product $product
     * @param ProductVariationType $productVariationType
     * @param ProductVariation $productVariation
     * @return ProductVariationResource
     */
    public function show(Product $product, ProductVariationType $productVariationType, ProductVariation $productVariation)
    {
        $this->authorize('update', $product);

        return ProductVariationResource::make($productVariation);
    }

    /**
     * Store a new product variation.
     *
     * @param Product $product
     * @param Request $request
     * @return ProductVariationResource
     */
    public function store(Product $product, Request $request)
    {
        $this->authorize('update', $product);

        $productVariation = $product->variations()->create([
            'product_variation_type_id' => $request->product_variation_type_id
        ]);

        return ProductVariationResource::make($productVariation);
    }
}
