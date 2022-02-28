<?php

namespace Tests\Feature\ProductVariations;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Http\Resources\ProductVariations\ProductVariationResource;

class ProductVariationShowTest extends TestCase
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

        $this->product->variations()->save(
            $this->productVariation = ProductVariation::factory()->make([
                'product_variation_type_id' => $this->productVariationType->id
            ])
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('product-variations.show', [
            $this->product,
            $this->productVariation
        ]));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $response = $this->getJsonAs(
            $this->user,
            route('product-variations.show', [$this->product, 999])
        );

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_product()
    {
        $otherProduct = Product::factory()->create();
        $otherProductVariationType = $otherProduct->types()->create();
        $otherProductVariation = $otherProduct->variations()->create([
            'product_variation_type_id' => $otherProductVariationType->id
        ]);

        $response = $this->getJsonAs($this->user, route('product-variations.show', [
            $otherProduct,
            $otherProductVariation
        ]));

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_get_a_product_variation()
    {
        $response = $this->getJsonAs(
            $this->user,
            route('product-variations.show', [
                $this->product,
                $this->productVariation
            ])
        );

        $response->assertSuccessful();
    }

    /** @test */
    public function it_returns_a_product_variation_resource()
    {
        $response = $this->getJsonAs(
            $this->user,
            route('product-variations.show', [
                $this->product,
                $this->productVariation
            ])
        );

        $response->assertResource(ProductVariationResource::make($this->product->variations->first()));
    }
}
