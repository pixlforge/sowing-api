<?php

namespace Tests\Unit\Products;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use App\Money\Money;

class ProductTest extends TestCase
{
    /** @test */
    public function it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product();

        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    /** @test */
    public function it_has_many_categories()
    {
        $product = factory(Product::class)->create();

        $product->categories()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $product->categories->first());
    }

    /** @test */
    public function it_has_many_variations()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            factory(Variation::class)->create()
        );

        $this->assertInstanceOf(Variation::class, $product->variations->first());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Money::class, $product->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $this->assertEquals('CHF10.00', $product->formattedPrice);
    }
}
