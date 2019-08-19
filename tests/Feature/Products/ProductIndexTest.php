<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;

class ProductIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->product = factory(Product::class)->create();
    }
    
    /** @test */
    public function it_shows_a_collection_of_products()
    {
        $response = $this->getJson(route('products.index'));

        $response->assertJsonFragment([
            'id' => $this->product->id
        ]);
    }

    /** @test */
    public function it_has_paginated_data()
    {
        $response = $this->getJson(route('products.index'));

        $response->assertJsonStructure(['data', 'links']);
    }
}
