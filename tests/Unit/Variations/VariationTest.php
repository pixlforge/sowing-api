<?php

namespace Tests\Unit\Variations;

use Tests\TestCase;
use App\Models\Type;
use App\Models\Variation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class VariationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_one_variation_type()
    {
        $variation = factory(Variation::class)->create();

        $this->assertInstanceOf(Type::class, $variation->type);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $variation = factory(Variation::class)->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }
}
