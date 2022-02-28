<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductScopingTest extends TestCase
{
    /** @test */
    public function it_can_scope_by_category()
    {
        $product = Product::factory()->create();

        $product->categories()->save(
            $category = Category::factory()->create()
        );

        Product::factory()->create();

        $response = $this->getJson(route('products.index', ['category' => $category->slug]));

        $response->assertJsonCount(1, 'data');
    }
}
