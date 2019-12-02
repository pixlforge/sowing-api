<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->shop()->save(
            $this->shop = factory(Shop::class)->make()
        );

        $this->category = factory(Category::class)->create();

        $this->user->shop->products()->save(
            $this->product = factory(Product::class)->make()
        );
    }

    /** @test */
    public function it_requires_a_category_id()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product));

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_requires_a_valid_category()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'category_id' => 999
        ]);

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_associates_the_product_with_the_provided_category()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            // 'price' => Arr::random(range(1000, 20000, 5)),
            'category_id' => $this->category->id
        ]);

        $response->assertSuccessful();

        $this->assertEquals(
            $this->category->id,
            $this->user->fresh()->shop->products->first()->categories->first()->id
        );
    }

    /** @test */
    public function it_requires_a_price()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_numeric()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 'abc'
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_least_100_cents()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 99
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_most_99995_cents()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 1000000,
        ]);

        $response->assertJsonValidationErrors(['price']);
    }
}
