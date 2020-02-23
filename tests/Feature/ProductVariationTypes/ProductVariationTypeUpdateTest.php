<?php

namespace Tests\Feature\ProductVariationTypes;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariationType;
use Illuminate\Foundation\Testing\WithFaker;

class ProductVariationTypeUpdateTest extends TestCase
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
            $this->type = factory(ProductVariationType::class)->make()
        );
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('product-variation-types.update', [$this->product, $this->type]));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_product()
    {
        $otherProduct = factory(Product::class)->create();

        $response = $this->patchJsonAs(
            $this->user,
            route('product-variation-types.update', [$otherProduct, $this->type]),
            [
                'name' => [
                    'fr' => 'Updated title'
                ]
            ]
        );

        $response->assertForbidden();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $response = $this->patchJsonAs(
            $this->user,
            route('product-variation-types.update', [$this->product, $this->type])
        );

         $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_updates_the_name()
    {
        $response = $this->patchJsonAs(
            $this->user,
            route('product-variation-types.update', [$this->product, $this->type]),
            [
                'name' => [
                    'fr' => $nameFr = $this->faker->firstNameFemale,
                    'en' => $this->faker->firstNameFemale,
                    'de' => $this->faker->firstNameFemale,
                    'it' => $this->faker->firstNameFemale,
                ]
            ]
        );

        $response->assertSuccessful();

        $this->assertEquals($nameFr, $this->type->fresh()->name);
    }
}
