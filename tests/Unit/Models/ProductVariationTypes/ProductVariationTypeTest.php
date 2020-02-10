<?php

namespace Tests\Unit\Models\ProductVariationTypes;

use App\Models\Product;
use Tests\TestCase;
use App\Models\ProductVariationType;

class ProductVariationTypeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->productVariationType = factory(ProductVariationType::class)->create();
    }
    
    /** @test */
    public function it_belongs_to_a_product()
    {   
        $this->assertInstanceOf(Product::class, $this->productVariationType->product);
    }
}
