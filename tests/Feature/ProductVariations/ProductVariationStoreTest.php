<?php

namespace Tests\Feature\ProductVariations;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariationType;
use App\Http\Resources\ProductVariations\ProductVariationResource;

class ProductVariationStoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->shop()->save(
            $this->shop = Shop::factory()->make()
        );

        $this->shop->products()->save(
            $this->product = Product::factory()->make()
        );

        $this->product->types()->save(
            $this->productVariationType = ProductVariationType::factory()->make()
        );
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('product-variations.store', [$this->product, $this->productVariationType]));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_product()
    {
        $otherProduct = Product::factory()->create();
        $otherProductVariationType = $otherProduct->types()->save(
            ProductVariationType::factory()->make()
        );

        $response = $this->postJsonAs($this->user, route('product-variations.store', [$otherProduct, $otherProductVariationType]));

        $response->assertForbidden();
    }
    
    /** @test */
    public function it_creates_a_product_variation()
    {
        $this->withoutExceptionHandling();
        
        $this->assertCount(0, $this->product->variations);
        
        $response = $this->postJsonAs(
            $this->user,
            route('product-variations.store', $this->product),
            [
                'product_variation_type_id' => $this->productVariationType->id
            ]
        );

        $response->assertSuccessful();

        $this->assertCount(1, $this->product->fresh()->variations);
    }

    /** @test */
    public function it_returns_a_product_variation_resource()
    {
        $response = $this->postJsonAs(
            $this->user,
            route('product-variations.store', $this->product),
            [
                'product_variation_type_id' => $this->productVariationType->id
            ]
        );

        $response->assertSuccessful();

        $response->assertResource(ProductVariationResource::make($this->product->variations->first()));
    }
}
