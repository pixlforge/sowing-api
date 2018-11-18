<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Scoping\Scopes\CategoryScope;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductIndexResource;

class ProductController extends Controller
{
    /**
     * Returns a collection of scoped products.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = Product::with(['variations.stock'])
            ->withScopes($this->scopes())
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
            'variations.type',
            'variations.stock',
            'variations.product',
        ]);

        return new ProductResource($product);
    }

    /**
     * Returns an array of scopes by which a product can be scoped.
     *
     * @return array
     */
    protected function scopes()
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
