<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;

class ProductShowTest extends TestCase
{
    /** @test */
    public function it_fails_if_a_product_cannot_be_found()
    {
        $response = $this->getJson(route('products.show', 'nope'));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_shows_a_product()
    {
        $product = factory(Product::class)->create();
        
        $response = $this->getJson(route('products.show', $product->slug));

        $response->assertJsonFragment([
            'id' => $product->id
        ]);
    }
}
