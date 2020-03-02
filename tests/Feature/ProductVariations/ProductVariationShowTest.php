<?php

namespace Tests\Feature\ProductVariations;

use App\Http\Resources\ProductVariations\ProductVariationResource;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;

class ProductVariationShowTest extends TestCase
{
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

        $this->product->variations()->save(
            $this->productVariation = factory(ProductVariation::class)->make([
                'product_variation_type_id' => $this->productVariationType->id
            ])
        );
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('product-variations.show', [
            $this->product,
            $this->productVariationType,
            $this->productVariation
        ]));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_product_variation_cannot_be_found()
    {
        $response = $this->getJsonAs($this->user, route('product-variations.show', [
            $this->product,
            $this->productVariationType,
            999
        ]));

        $response->assertNotFound();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_product()
    {
        $otherProduct = factory(Product::class)->create();
        $otherProductVariationType = $otherProduct->types()->create();
        $otherProductVariation = $otherProduct->variations()->create([
            'product_variation_type_id' => $otherProductVariationType->id
        ]);

        $response = $this->getJsonAs($this->user, route('product-variations.show', [
            $otherProduct,
            $otherProductVariationType,
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
                $this->productVariationType,
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
                $this->productVariationType,
                $this->productVariation
            ])
        );

        $response->assertResource(ProductVariationResource::make($this->product->variations->first()));
    }
}
