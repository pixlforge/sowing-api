<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductIndexResource;

class ProductController extends Controller
{
    /**
     * Returns a collection of scoped products.
     *
     * @return ProductIndexResource
     */
    public function index()
    {
        $products = Product::with([
                'shop', 'variations.stock',
            ])
            ->withScopes()
            ->paginate(10);

        return ProductIndexResource::collection($products);
    }

    /**
     * Returns a specific product resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        $product->load([
            'variations.type', 'variations.stock', 'variations.product',
        ]);

        return ProductResource::make($product);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return response($request->all(), 200);
    }
}
