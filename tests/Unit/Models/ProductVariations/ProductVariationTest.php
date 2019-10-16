<?php

namespace Tests\Unit\Variations;

use Tests\TestCase;
use App\Money\Money;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;

class ProductVariationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->variation = factory(ProductVariation::class)->create();
    }
    
    /** @test */
    public function it_has_one_variation_type()
    {
        $this->assertInstanceOf(ProductVariationType::class, $this->variation->type);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $this->assertInstanceOf(Product::class, $this->variation->product);
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $this->assertInstanceOf(Money::class, $this->variation->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $this->assertEquals(
            (new Money($this->variation->price->getAmount()))->formatted(),
            $this->variation->formattedPrice
        );
    }

    /** @test */
    public function it_returns_the_product_price_if_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $product->variations()->save(
            $variation = factory(ProductVariation::class)->create([
                'price' => null
            ])
        );

        $this->assertEquals($product->price->getAmount(), $variation->price->getAmount());
    }

    /** @test */
    public function it_can_check_if_the_variation_price_is_different_from_the_product()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $product->variations()->save(
            $variation = factory(ProductVariation::class)->create([
                'price' => 2000
            ])
        );

        $this->assertTrue($variation->priceVaries());
    }

    /** @test */
    public function it_has_many_stocks()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->create()
        );

        $this->assertInstanceOf(Stock::class, $this->variation->stocks->first());
    }

    /** @test */
    public function it_has_stock_information()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $this->variation->stock->first());
    }

    /** @test */
    public function it_has_stock_count_pivot_within_stock_information()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($quantity, $this->variation->stock->first()->pivot->stock);
    }

    /** @test */
    public function it_has_in_stock_pivot_within_stock_information()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($this->variation->stock->first()->pivot->in_stock);
    }

    /** @test */
    public function it_can_check_if_it_is_in_stock()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($this->variation->inStock());
    }

    /** @test */
    public function it_can_get_the_stock_count()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($quantity, $this->variation->stockCount());
    }

    /** @test */
    public function it_can_get_the_minimum_stock_for_a_given_value()
    {
        $this->variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($quantity, $this->variation->minStock(200));
    }
}
