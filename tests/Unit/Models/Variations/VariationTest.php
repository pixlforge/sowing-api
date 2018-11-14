<?php

namespace Tests\Unit\Variations;

use Tests\TestCase;
use App\Money\Money;
use App\Models\Type;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Stock;

class VariationTest extends TestCase
{
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

    /** @test */
    public function it_returns_a_money_instance_for_the_price()
    {
        $variation = factory(Variation::class)->create();

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    /** @test */
    public function it_returns_a_formatted_price()
    {
        $variation = factory(Variation::class)->create();

        $this->assertEquals('CHF10.00', $variation->formattedPrice);
    }

    /** @test */
    public function it_returns_the_product_price_if_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $product->variations()->save(
            $variation = factory(Variation::class)->create([
                'price' => null
            ])
        );

        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }

    /** @test */
    public function it_can_check_if_the_variation_price_is_different_from_the_product()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $product->variations()->save(
            $variation = factory(Variation::class)->create([
                'price' => 2000
            ])
        );

        $this->assertTrue($variation->priceVaries());
    }

    /** @test */
    public function it_has_many_stocks()
    {
        $variation = factory(Variation::class)->create();

        $variation->stocks()->save(
            $stocks = factory(Stock::class)->create()
        );

        $this->assertInstanceOf(Stock::class, $variation->stocks->first());
    }
}
