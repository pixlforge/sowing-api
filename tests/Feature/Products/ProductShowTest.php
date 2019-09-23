<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;
use App\Http\Resources\Products\ProductResource;

class ProductShowTest extends TestCase
{
    /** @test */
    public function it_fails_if_a_product_cannot_be_found()
    {
        $response = $this->getJson(route('products.show', 'nope'));

        $response->assertNotFound();
    }

    /** @test */
    public function it_returns_a_product_resource()
    {
        $product = factory(Product::class)->create();

        $response = $this->getJson(route('products.show', $product->slug));

        $response->assertResource(ProductResource::make($product));
    }
}
