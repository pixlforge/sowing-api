<?php

namespace Tests\Feature\ProductVariationTypes;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductVariationType;
use Illuminate\Foundation\Testing\WithFaker;

class ProductVariationTypeDestroyTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->shop()->save(
            $this->shop = factory(Shop::class)->make()
        );

        $this->shop->products()->save(
            $this->product = factory(Product::class)->make()
        );

        $this->product->types()->save(
            $this->productVariationType = factory(ProductVariationType::class)->make()
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->deleteJson(
            route('product-variation-types.destroy', [$this->product, $this->productVariationType])
        );

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_does_not_delete_the_product_variation_type_if_the_user_does_not_own_it()
    {
        $otherProduct = factory(Product::class)->create();

        $otherProduct->types()->save(
            $otherProductVariationType = factory(ProductVariationType::class)->make()
        );

        $this->assertCount(1, $otherProduct->types);
        
        $response = $this->deleteJsonAs(
            $this->user,
            route('product-variation-types.destroy', [$otherProduct, $otherProductVariationType])
        );

        $response->assertForbidden();

        $this->assertCount(1, $otherProduct->fresh()->types);
    }

    /** @test */
    public function it_deletes_a_product_variation_type()
    {
        $this->assertCount(1, $this->product->types);
        
        $response = $this->deleteJsonAs(
            $this->user,
            route('product-variation-types.destroy', [$this->product, $this->productVariationType])
        );

        $response->assertSuccessful();

        $this->assertCount(0, $this->product->fresh()->types);
    }
}
