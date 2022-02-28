<?php

namespace Tests\Unit\Products;

use Tests\TestCase;
use App\Money\Money;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Illuminate\Foundation\Testing\WithFaker;

class ProductTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
    }

    /** @test */
    public function it_uses_the_slug_for_the_route_key_name()
    {
        $this->assertEquals('slug', $this->product->getRouteKeyName());
    }

    /** @test */
    public function it_has_many_categories()
    {
        $this->product->categories()->save(
            Category::factory()->create()
        );

        $this->assertInstanceOf(Category::class, $this->product->categories->first());
    }

    /** @test */
    public function it_has_many_variations()
    {
        $this->product->variations()->save(
            ProductVariation::factory()->create()
        );

        $this->assertInstanceOf(ProductVariation::class, $this->product->variations->first());
    }

    /** @test */
    public function it_has_many_types()
    {
        $this->product->types()->save(
            ProductVariationType::factory()->make()
        );

        $this->assertInstanceOf(ProductVariationType::class, $this->product->types->first());
    }

    /** @test */
    public function it_belongs_to_a_shop()
    {
        $this->assertInstanceOf(Shop::class, $this->product->shop);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $this->assertInstanceOf(Money::class, $this->product->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $this->assertEquals(
            (new Money($this->product->price->getAmount()))->formatted(),
            $this->product->formattedPrice
        );
    }

    /** @test */
    public function it_can_check_if_it_is_in_stock()
    {
        $this->product->variations()->save(
            $variation = ProductVariation::factory()->make()
        );

        $variation->stocks()->save(
            Stock::factory()->make([
                'quantity' => $this->faker->randomDigitNotNull
            ])
        );

        $this->assertTrue($this->product->inStock());
    }

    /** @test */
    public function it_can_get_the_stock_count()
    {
        $this->product->variations()->save(
            $variation = ProductVariation::factory()->make()
        );

        $variation->stocks()->save(
            Stock::factory()->make([
                'quantity' => $quantity = $this->faker->randomDigitNotNull
            ])
        );

        $this->assertEquals($quantity, $this->product->stockCount());
    }
}
