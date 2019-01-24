<?php

namespace Tests\Unit\Products;

use Tests\TestCase;
use App\Money\Money;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Stock;
use App\Models\Shop;

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
    public function it_belongs_to_a_shop()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Shop::class, $product->shop);
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

    /** @test */
    public function it_can_check_if_it_is_in_stock()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            $variation = factory(Variation::class)->make()
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 50
            ])
        );

        $this->assertTrue($product->inStock());
    }

    /** @test */
    public function it_can_get_the_stock_count()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            $variation = factory(Variation::class)->make()
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 50
            ])
        );

        $this->assertEquals($quantity, $product->stockCount());
    }
}
