<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\Products\ProductIndexResource;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api'])->only([
            'store', 'update'
        ]);
    }
    
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
            ->get();

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
            'types', 'variations.type', 'variations.stock', 'variations.product',
        ]);

        return ProductResource::make($product);
    }

    /**
     * Add a new product resource.
     *
     * @param Request $request
     * @return ProductResource
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $request->user()->shop->products()->create($request->validated());

        return ProductResource::make($product);
    }

    /**
     * Update a product.
     *
     * @param Product $product
     * @param ProductUpdateRequest $request
     * @return ProductResource
     */
    public function update(Product $product, ProductUpdateRequest $request)
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        if ($request->has('category_id')) {
            $product->categories()->sync($request->category_id);
        }

        return ProductResource::make($product);
    }
}
