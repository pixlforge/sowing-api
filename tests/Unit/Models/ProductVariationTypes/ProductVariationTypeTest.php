<?php

namespace Tests\Unit\Models\ProductVariationTypes;

use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductVariationType;

class ProductVariationTypeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->productVariationType = ProductVariationType::factory()->create();
    }
    
    /** @test */
    public function it_belongs_to_a_product()
    {   
        $this->assertInstanceOf(Product::class, $this->productVariationType->product);
    }

    /** @test */
    public function it_returns_the_model_id()
    {
        $this->assertEquals($this->productVariationType->id, $this->productVariationType->id());
    }
}
