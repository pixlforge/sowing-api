<?php

namespace Tests\Feature\ProductVariationTypes;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Http\Resources\ProductVariationTypes\ProductVariationTypeResource;

class ProductVariationTypeStoreTest extends TestCase
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
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('product-variation-types.store', $this->product));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_product()
    {
        $product = Product::factory()->create();

        $response = $this->postJsonAs($this->user, route('product-variation-types.store', $product));

        $response->assertForbidden();
    }

    /** @test */
    public function it_creates_a_product_variation_type()
    {
        $this->assertEquals(0, $this->product->types->count());

        $response = $this->postJsonAs($this->user, route('product-variation-types.store', $this->product));

        $response->assertStatus(201);

        $this->assertEquals(1, $this->product->fresh()->types->count());
    }

    /** @test */
    public function it_returns_a_product_variation_type_resource()
    {
        $response = $this->postJsonAs($this->user, route('product-variation-types.store', $this->product));

        $response->assertResource(ProductVariationTypeResource::make($this->product->types->first()));
    }
}
